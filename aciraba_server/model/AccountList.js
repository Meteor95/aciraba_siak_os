const utils = require("../config/utils");
const siakdata = require("../model/SiakData");

class AccountList {
    constructor(req, data, con) {
        this.req = req;
        this.con = con;
        this.id = 0;
        this.name = '';
        this.code = '';

        this.g_parent_id = 0; 
        this.g_affects_gross = 0;
        this.l_group_id = 0;    
        this.l_type = 0;    
        this.l_reconciliation = 0;
        this.l_notes = '';   

        this.jenisakun = '';
        this.defaultinput = '';
        this.op_total = 0;
        this.op_total_dc = 'D';
        this.dr_total = 0;
        this.cr_total = 0;
        this.cl_total = 0;
        this.cl_total_dc = 'D';

        this.children_groups = [];
        this.children_ledgers = [];

        this.counter = 0;

        this.only_opening = false;
        this.affects_gross = -1;

        this.Group = null;
        this.Ledger = null;
    }

    async mulai(idcoaawalan) {
        if (idcoaawalan == 0) {
            this.id = 0;
            this.name = "None";
        } else {
            this.id = idcoaawalan;
            const informasientrijurnal = await utils.eksekusiQueryPromise(this.req, `SELECT ID,PARENT_ID,KODE_COA_GROUP,NAMA_COA_GROUP,DEFAULTINPUT,JENISAKUN,SALDOAWAL,SALDOAWALDC,KASBANK FROM 01_siak_coa as A JOIN 01_tms_perusahaan as B ON A.AIPERUSAHAAN = B.KODEPERUSAHAAN WHERE ID = ? AND A.KODEUNIKMEMBER = ? AND A.AIPERUSAHAAN = ? AND B.KODEUNIKMEMBER = ? AND B.KODEPERUSAHAAN = ? ORDER BY PARENT_ID, ID ASC`, [this.id, this.req.body.KODEUNIKMEMBER, this.req.body.SUBPERUSAHAAN, this.req.body.KODEUNIKMEMBER, this.req.body.SUBPERUSAHAAN], this.con);
            if (informasientrijurnal.length > 0) {
                const row = informasientrijurnal[0];
                this.id = row.ID;
                this.name = row.NAMA_COA_GROUP;
                this.code = row.KODE_COA_GROUP;
                this.g_parent_id = row.PARENT_ID;
                this.defaultinput = row.DEFAULTINPUT;
                this.g_affects_gross = 1;
            }
        }
        this.op_total = 0;
        this.op_total_dc = 'D';
        this.dr_total = 0;
        this.cr_total = 0;
        this.cl_total = 0;
        this.cl_total_dc = 'D';
        await this.subgrup();
        await this.subledgers();
        return this.toJSON();
    }

    async subgrup() {
        const datagrup = await utils.eksekusiQueryPromise(this.req, `SELECT ID,PARENT_ID,KODE_COA_GROUP,NAMA_COA_GROUP,DEFAULTINPUT,JENISAKUN,SALDOAWAL,SALDOAWALDC,KASBANK FROM 01_siak_coa as A JOIN 01_tms_perusahaan as B ON A.AIPERUSAHAAN = B.KODEPERUSAHAAN WHERE JENISAKUN = 'GRUP' AND PARENT_ID = ? AND A.KODEUNIKMEMBER = ? AND A.AIPERUSAHAAN = ? AND B.KODEUNIKMEMBER = ? AND B.KODEPERUSAHAAN = ? ORDER BY KODE_COA_GROUP ASC`, [this.id, this.req.body.KODEUNIKMEMBER, this.req.body.SUBPERUSAHAAN, this.req.body.KODEUNIKMEMBER, this.req.body.SUBPERUSAHAAN], this.con);
        if (datagrup.length > 0) {
            this.counter = 0;
            for (const row of datagrup) {
                this.children_groups[this.counter] = new AccountList(this.req, "", this.con);
                //console.log(`Starting subgroup: ${row.ID}`);
                await this.children_groups[this.counter].mulai(row.ID); // Await here
                //console.log(`Finished subgroup: ${row.ID}`);
                this.children_groups[this.counter].jenisakun = row.JENISAKUN
                this.children_groups[this.counter].defaultinput = row.DEFAULTINPUT
                let temp1 = utils.calculate_withdc(
                    this.op_total,
                    this.op_total_dc,
                    this.children_groups[this.counter].op_total,
                    this.children_groups[this.counter].op_total_dc,
                    row.DEFAULTINPUT
                );
                this.op_total = temp1['amount'];
                this.op_total_dc = temp1['dc'];
                let temp2 = utils.calculate_withdc(
                    this.cl_total,
                    this.cl_total_dc,
                    this.children_groups[this.counter].cl_total,
                    this.children_groups[this.counter].cl_total_dc,
                    row.DEFAULTINPUT
                );
                this.cl_total = temp2['amount'];
                this.cl_total_dc = temp2['dc'];
                /* Calculate Dr and Cr total */
                this.dr_total = utils.calculate(this.dr_total, this.children_groups[this.counter].dr_total, '+');
                this.cr_total = utils.calculate(this.cr_total, this.children_groups[this.counter].cr_total, '+');
                this.dr_sum = utils.calculate(this.cl_total, this.children_groups[this.counter].cl_total, '+');
                this.cr_sum = utils.calculate(this.cl_total, this.children_groups[this.counter].cl_total, '+');
                this.counter++;
            }
        }
    }

    async subledgers() {
        const informasientrijurnal = await utils.eksekusiQueryPromise(this.req, `SELECT ID,PARENT_ID,KODE_COA_GROUP,NAMA_COA_GROUP,DEFAULTINPUT,JENISAKUN,SALDOAWAL,SALDOAWALDC,KASBANK FROM 01_siak_coa as A JOIN 01_tms_perusahaan as B ON A.AIPERUSAHAAN = B.KODEPERUSAHAAN WHERE JENISAKUN = 'LEDGER' AND PARENT_ID = ? AND A.KODEUNIKMEMBER = ? AND A.AIPERUSAHAAN = ? AND B.KODEUNIKMEMBER = ? AND B.KODEPERUSAHAAN = ? ORDER BY KODE_COA_GROUP ASC`, [this.id, this.req.body.KODEUNIKMEMBER, this.req.body.SUBPERUSAHAAN, this.req.body.KODEUNIKMEMBER, this.req.body.SUBPERUSAHAAN], this.con);
        this.counter = 0;
        for (const row of informasientrijurnal) {
            this.children_ledgers[this.counter] = {};
            this.children_ledgers[this.counter]['id'] = row.ID;
            this.children_ledgers[this.counter]['name'] = row.NAMA_COA_GROUP;
            this.children_ledgers[this.counter]['code'] = row.KODE_COA_GROUP;
            this.children_ledgers[this.counter]['l_group_id'] = row.PARENT_ID;
            this.children_ledgers[this.counter]['l_type'] = row.KASBANK;
            this.children_ledgers[this.counter]['jenisakun'] = row.JENISAKUN;
            this.children_ledgers[this.counter]['defaultinput'] = row.DEFAULTINPUT;
            this.children_ledgers[this.counter]['op_total'] = row.SALDOAWAL;
            this.children_ledgers[this.counter]['op_total_dc'] = row.SALDOAWALDC;

            // Calculating current group opening balance total
            let temp3 = utils.calculate_withdc(
                this.op_total,
                this.op_total_dc,
                this.children_ledgers[this.counter]['op_total'],
                this.children_ledgers[this.counter]['op_total_dc']
            );

            this.op_total = temp3['amount'];
            this.op_total_dc = temp3['dc'];

            this.req.body.COAID = row.ID;
            this.req.body.KODEUNIKMEMBER = this.req.body.KODEUNIKMEMBER;
            this.req.body.SUBPERUSAHAAN = this.req.body.SUBPERUSAHAAN;
            let cl = await siakdata.closingBalance(this.req, "", this.req.con);
            this.children_ledgers[this.counter]['dr_total'] = cl.dr_total;
            this.children_ledgers[this.counter]['cr_total'] = cl.cr_total;
            this.children_ledgers[this.counter]['cl_total'] = cl.amount;
            this.children_ledgers[this.counter]['cl_total_dc'] = cl.dc;

            // Calculating current group closing balance total
            let temp4 = utils.calculate_withdc(
                this.cl_total,
                this.cl_total_dc,
                this.children_ledgers[this.counter]['cl_total'],
                this.children_ledgers[this.counter]['cl_total_dc']
            );

            this.cl_total = temp4['amount'];
            this.cl_total_dc = temp4['dc'];

            // Calculate Dr and Cr total
            this.dr_total = utils.calculate(this.dr_total, this.children_ledgers[this.counter]['dr_total'], '+');
            this.cr_total = utils.calculate(this.cr_total, this.children_ledgers[this.counter]['cr_total'], '+');
            this.counter++;
        }
        //console.log("Completed subledgers. Current state of children_ledgers:", this.children_ledgers); // Log children_ledgers here
    }

    toJSON() {
        return {
            id: this.id,
            name: this.name,
            code: this.code,
            g_parent_id: this.g_parent_id,
            g_affects_gross: this.g_affects_gross,
            l_group_id: this.l_group_id,
            l_type: this.l_type,
            l_reconciliation: this.l_reconciliation,
            l_notes: this.l_notes,
            jenisakun: this.jenisakun,
            defaultinput: this.defaultinput,
            op_total: this.op_total,
            op_total_dc: this.op_total_dc,
            dr_total: this.dr_total,
            cr_total: this.cr_total,
            cl_total: this.cl_total,
            cl_total_dc: this.cl_total_dc,
            children_groups: this.children_groups.map(group => group.toJSON()),
            children_ledgers: this.children_ledgers
        };
    }
}

module.exports = AccountList;