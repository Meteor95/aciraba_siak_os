const MySQLEvents = require('@rodrigogs/mysql-events');
require("dotenv").config()
const util = require('../config/utils');

module.exports = {
	updateBarangKeluar: (io,con) => {
		pesanbalik = [];
		const instance = new MySQLEvents(con, {startAtEnd: true,includeSchema: { 'aciraba_website': ['01_trs_barangkeluar','01_trs_barangkeluar_detail']}});
		instance.start();
		instance.addTrigger({
			name: 'Get new information update from barang_keluar',
			expression: '*',
			statement: MySQLEvents.STATEMENTS.ALL,
			onEvent: async (listenerdatabase) => { 
				if (listenerdatabase["type"] == "INSERT" && listenerdatabase["table"] == "01_trs_barangkeluar"){
					
				}
			},
		});
		instance.on(MySQLEvents.EVENTS.CONNECTION_ERROR, console.error);
		instance.on(MySQLEvents.EVENTS.ZONGJI_ERROR, console.error);
	}
};
