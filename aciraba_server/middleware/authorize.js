var { expressjwt: jwt } = require("express-jwt");
const util = require('../config/utils');
let pesanbalik = {}

const authMiddleware = jwt({
    secret: process.env.ACCESS_TOKEN_RHS,
    algorithms: ['HS256'],
});
const tokenAPIMiddleware = async (req, res, next) => {
    pesanbalik = [];
    const token = req.header('Authorization'), keyidtoken = token.split(' ')[0], idtoken = token.split(' ')[1], partsidtoken = Buffer.from(idtoken, 'base64').toString('ascii').split(':::');
    if (!token) {
        data = {
            success: false,
            rc: 404,
            msg: "Token tidak terdaftar pada pada sistem database kami. Silahkan lakukan pembuatan token atau lakukan pembaruan token",
            data: []
        };
        pesanbalik.push(data)
        return res.json({ aciaraba_json: pesanbalik.concat([data]) });
    }
    if (keyidtoken !== "ERAYADIGITALSOLUSINDO") {
        data = {
            success: false,
            rc: 404,
            msg: "Token HEADER ID tidak sama dengan Token Header ID kami",
            data: []
        };
        pesanbalik.push(data)
        return res.json({ aciaraba_json: pesanbalik.concat([data]) });
    }
    try {
        const ceklisensi = await util.eksekusiQueryPromise(req, 'SELECT LISENSI FROM 01_set_onpremise WHERE NAMAPENGGUNA = ? LIMIT 1', [req.body.NAMAPENGGUNA], req.con);
        if (ceklisensi.length == 0){
            data = {
                success: false,
                rc: 404,
                msg: "Pastikan informasi yang anda masukkan valid, tidak terblokir dan terdaftar pada sistem kami",
                data: []
            };
            pesanbalik.push(data)
            return res.json({ aciaraba_json: pesanbalik.concat([data]) });
        }
        if (ceklisensi[0].LISENSI === partsidtoken[0]) {
            if (partsidtoken[1] == '') return next();
            const cekHash = await util.eksekusiQueryPromise(req, 'SELECT TOKENKEY FROM 01_tms_penggunaaplikasi WHERE NAMAPENGGUNA = ? LIMIT 1', [req.body.NAMAPENGGUNA], req.con);
            if (cekHash[0].TOKENKEY == partsidtoken[1]) {
                return next();
            }
        }
    } catch (error) {
        data = {
            success: false,
            rc: 404,
            msg: "Terjadi kesalahan. Error "+error,
            data: []
        };
        pesanbalik.push(data)
        return res.json({ aciaraba_json: pesanbalik.concat([data]) });
    }
};
module.exports = {
    authMiddleware: authMiddleware,
    tokenAPIMiddleware: tokenAPIMiddleware
};