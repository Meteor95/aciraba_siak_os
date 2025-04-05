require('dotenv').config()
const util = require('../config/utils');
const sp = {}
var pesanbalik = {}

sp.dataquery_controller_website = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Website(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12], data[13], data[14], data[15], data[16], data[17], data[18], data[19], data[20],data[21],data[22]], con);
    if (dataquery[0].length > 0) {
        data = {
            success: "true",
            totaldata: dataquery[0].length,
            dataquery: dataquery[0],
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
            totaldata: 0,
            dataquery: [],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
sp.dataquery_controller_admin = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length > 0) {
        data = {
            success: "true",
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
            totaldata: dataquery[0].length,
            dataquery: dataquery[0],
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
            totaldata: 0,
            dataquery: [],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
sp.dataquery_controller_kasir = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Kasir(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length > 0) {
        data = {
            success: "true",
            totaldata: dataquery[0].length,
            dataquery: dataquery[0],
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
            totaldata: 0,
            dataquery: [],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
module.exports = sp;