const https = require('https');
const fs = require('fs');

function downloadFile(url, dest) {
  return new Promise((resolve, reject) => {
    const file = fs.createWriteStream(dest);
    https.get(url, function(response) {
      response.pipe(file);
      file.on('finish', function() {
        file.close(resolve);
      });
    }).on('error', function(err) {
      fs.unlink(dest, () => {});
      reject(err.message);
    });
  });
}

async function run() {
  await downloadFile("https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ8Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpbCiVodG1sXzAwMDY1NmExMWQyNGJlYTMwMzgzOTJmYjc4MzM4MTc1EgsSBxDzkdWY6xUYAZIBJAoKcHJvamVjdF9pZBIWQhQxNDk0NTc1MTM1MzM1NDQ0MjUzMw&filename=&opi=89354086", "temp_screens/venues.html");
  await downloadFile("https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ8Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpbCiVodG1sXzAwMDY1NmExMWQzMGYyZTUwMmE5ODFjMTk5MGQ2MDk0EgsSBxDzkdWY6xUYAZIBJAoKcHJvamVjdF9pZBIWQhQxNDk0NTc1MTM1MzM1NDQ0MjUzMw&filename=&opi=89354086", "temp_screens/venue_detail.html");
  console.log("Done");
}

run();
