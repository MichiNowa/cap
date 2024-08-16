const https = require('https');
const httpProxy = require('http-proxy');
const fs = require('fs');
const path = require('path');

const passphrase = 'smcc';

const options = {
  key: fs.readFileSync(path.join(__dirname, 'cert', 'server.key')),
  cert: fs.readFileSync(path.join(__dirname, 'cert', 'server.csr')),
  passphrase: passphrase
};

const proxy = httpProxy.createProxyServer({});

const server = https.createServer(options, (req, res) => {
  proxy.web(req, res, { target: 'http://localhost:8000' });
});

server.listen(3000, '0.0.0.0', () => {
  console.log('Server is running on https://localhost:3000');
});
