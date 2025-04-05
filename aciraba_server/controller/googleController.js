require('dotenv').config()
const path = require('path');
const {google} = require('googleapis');
const drive = google.drive('v3');
const fs = require('fs')
const googleapicallback = {}
const oauth2Client = new google.auth.OAuth2(
  process.env.GOOGLE_DRIVE_ID,
  process.env.GOGOLE_DRIVE_CLIENT,
  process.env.GOGOLE_DRIVE_CALLBACK,
);
try{
  const kredential = fs.readFileSync("kredentialgd.json")
  oauth2Client.credentials = JSON.parse(kredential);
}catch (err){
  console.log(err+". Kredential tidak ditemukan. Silahkan hubungi administrator");
}
googleapicallback.auth = async function(req,res){
  const scopes = [
    'https://www.googleapis.com/auth/userinfo.profile',
    'https://www.googleapis.com/auth/drive'
  ];
  const url = oauth2Client.generateAuthUrl({
    access_type: 'offline',
    scope: scopes
  });
  res.redirect(url)
}
googleapicallback.redirect = async function(req,res){
  const {code} = req.query
  const {tokens} = await oauth2Client.getToken(code)
  oauth2Client.credentials = tokens;
  fs.writeFileSync("kredentialgd.json",JSON.stringify(tokens))
}
googleapicallback.directory = async function(req,res){
  getfilelist.GetFolderTree(resource, function (err, res) {
    if (err) {
      console.log(err);
      return;
    }
    console.log(res);
  });
}
module.exports = googleapicallback