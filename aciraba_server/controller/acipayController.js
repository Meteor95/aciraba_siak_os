require('dotenv').config()
const acipaycallback = {}
const digiflazzController = require("../controller/digiflazzController")
const authController = require("../controller/authController")
const acipaymodel = require("../model/Acipay")
const util = require('../config/utils');

acipaycallback.webhookdigiflazz = async function(req,res){
  digiflazzController.webhook(req, res).then(function(val) {
    res.json({
      respon: val,
    });
  });
}
acipaycallback.ceksaldo = async function(req,res){
  if (req.body.SERVERID = "digiflazz"){
    digiflazzController.apidigiflazz(req, res).then(function(val) {
      res.json({
        respon: val,
      });
    });
  }
}
acipaycallback.cektokenpln = async function(req,res){
  if (req.body.SERVERID = "digiflazz"){
    digiflazzController.apidigiflazz(req, res).then(function(val) {
      res.json({
        respon: val,
      });
    });
  }
}
acipaycallback.deposit = async function(req,res){
  if (req.body.SERVERID = "digiflazz"){
    digiflazzController.apidigiflazz(req, res).then(function(val) {
      res.json({
        respon: val,
      });
    });
  }
}
acipaycallback.transaksi = async function(req,res){
  if (req.body.SERVERID = "digiflazz"){
    digiflazzController.apidigiflazz(req, res).then(function(val) {
      res.json({
        respon: val,
      });
    });
  }
}
acipaycallback.tagihan = async function(req,res){
  if (req.body.SERVERID = "digiflazz"){
    digiflazzController.apidigiflazz(req, res).then(function(val) {
      res.json({
        respon: val,
      });
    });
  }
}
acipaycallback.konekwebservice = async function(req,res){
  var data = []
	data.push(req.body.KATAKUNCI)
  data.push(req.body.KODEUNIKMEMBER)
	hasiljson = await acipaymodel.ajaxoperatordt(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
/* internal api */
acipaycallback.sinkronproduk = async function(req,res){
  let hasilproduk
  if (util.getWordBeforeUnderscore(req.body.SERVERID,0) == "digiflazz"){
    hasilproduk = await digiflazzController.apidigiflazz(req, res);
  }
  hasiljson = await acipaymodel.sinkronproduk(req, hasilproduk, req.con)
  res.json({
		respon: hasiljson,
	});
}
acipaycallback.kirimotp = async function(req,res){
  hasilotp = await authController.kirimotp(req,res,"","email")
  console.log(hasilproduk)
}
acipaycallback.bacaserver = async function(req,res){
  var data = []
	data.push(req.body.TIPE)
  data.push(req.body.KODEUNIKMEMBER)
  data.push(req.body.KATAKUNCI)
  data.push(req.body.DATAKE)
  data.push(req.body.LIMIT)
	hasiljson = await acipaymodel.bacaserver(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.ajaxoperatordt = async function(req,res){
  var data = []
	data.push(req.body.KATAKUNCI)
  data.push(req.body.KODEUNIKMEMBER)
	hasiljson = await acipaymodel.ajaxoperatordt(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.simpanoperator = async function(req,res){
  var data = []
	data.push(req.body.PRINCIPAL_ID)
  data.push(req.body.NAMA_PRINCIPAL)
  data.push(req.body.URL_CITRA)
  data.push(req.body.STATUS)
  data.push(req.body.PREFIX)
  data.push(req.body.KODEUNIKMEMBER)
  data.push(req.body.ISEDIT)
	hasiljson = await acipaymodel.simpanoperator(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.hapusoperator = async function(req,res){
  var data = []
	data.push(req.body.OPERATOR_ID)
  data.push(req.body.KODEUNIKMEMBER)
  hasiljson = await acipaymodel.hapusoperator(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.daftarkategori = async function(req,res){
  var data = []
	data.push(req.body.KATAKUNCI)
  data.push(req.body.KODEUNIKMEMBER)
  hasiljson = await acipaymodel.daftarkategori(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.simpankategori = async function(req,res){
  var data = []
	data.push(req.body.KATEGORI_ID)
  data.push(req.body.NAMAKATEGORI)
  data.push(req.body.URL_CITRA)
  data.push(req.body.STATUS)
  data.push(req.body.FORMAT)
  data.push(req.body.PLACEHOLDER)
  data.push(req.body.KETERANGAN)
  data.push(req.body.URUTAN)
  data.push(req.body.SLUG_URL)
  data.push(req.body.KODEUNIKMEMBER)
  data.push(req.body.ISEDIT)
  data.push(req.body.IDOPERATOR)
  data.push(req.body.IDVENDOR)
  hasiljson = await acipaymodel.simpankategori(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.hapuskategori = async function(req,res){
  var data = []
	data.push(req.body.KATEGORI_ID)
  data.push(req.body.KODEUNIKMEMBER)
  hasiljson = await acipaymodel.hapuskategori(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.daftarproduk = async function(req,res){
  var data = []
  hasiljson = await acipaymodel.daftarproduk(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.tambahprodukproses = async function(req,res){
  var data = []
  hasiljson = await acipaymodel.tambahprodukproses(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.hapusperproduk = async function(req,res){
  var data = []
  hasiljson = await acipaymodel.hapusperproduk(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
acipaycallback.getformat = async function(req,res){
  var data = []
  hasiljson = await acipaymodel.getformat(req, data, req.con)
	res.json({
		respon: hasiljson,
	});
}
module.exports = acipaycallback