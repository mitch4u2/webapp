const functions = require("firebase-functions");
const gcs = require("@google-cloud/storage")();
const os = require("os");
const path = require("path");
const spawn = require("child-process-promise").spawn;

// // Create and Deploy Your First Cloud Functions
// // https://firebase.google.com/docs/functions/write-firebase-functions
//
exports.onFileChange = functions.storage
  .object()
  .onFinalize((object, context) => {
    const bucket = object.bucket;
    const contentType = object.contentType;
    const filePath = object.name;
    console.log("File change detected, function execution started");

    if (path.basename(filePath).startsWith("resized-")) {
      console.log("we alreadt renamed that file");
      return;
    }

    if (object.resourceState === "not_exists") {
      console.log("we deleted a file, exit...");
      return;
    }

    const destBucket = gcs.bucket(bucket);
    const tmpFilePath = path.join(os.tmpdir(), path.basename(filePath));
    const metadata = { contentType: contentType };
    return destBucket
      .file(filePath)
      .download({
        destination: tmpFilePath
      })
      .then(() => {
        return spawn("convert", [
          tmpFilePath,
          "-resize",
          "500x500",
          tmpFilePath
        ]);
      })
      .then(() => {
        return destBucket.upload(tmpFilePath, {
          destination: "resized-" + path.basename(filePath),
          metadata: metadata
        });
      });
  });
