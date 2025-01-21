const videoElement = document.getElementById("input-video");
const canvasElement = document.getElementById("output_canvas");
const canvasCtx = canvasElement.getContext("2d");

let lastMouthOpenTime = 0; // Timestamp terakhir deteksi mulut terbuka

async function startCamera() {
  const stream = await navigator.mediaDevices.getUserMedia({
    video: true,
  });
  videoElement.srcObject = stream;
  videoElement.onloadedmetadata = () => {
    videoElement.play();
  };
}

startCamera();

const faceMesh = new FaceMesh({
  locateFile: (file) =>
    `https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh/${file}`,
});

faceMesh.setOptions({
  maxNumFaces: 1,
  refineLandmarks: true,
  minDetectionConfidence: 0.5,
  minTrackingConfidence: 0.5,
});

faceMesh.onResults(onResults);

const camera = new Camera(videoElement, {
  onFrame: async () => {
    await faceMesh.send({
      image: videoElement,
    });
  },
  width: 640,
  height: 480,
});
camera.start();

let mouthOpenDetected = false; // Status mulut terbuka
let eyeBlinkDetected = false; // Status kedip mata

function onResults(results) {
  canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
  canvasCtx.drawImage(
    results.image,
    0,
    0,
    canvasElement.width,
    canvasElement.height
  );

  if (results.multiFaceLandmarks) {
    for (const landmarks of results.multiFaceLandmarks) {
      // Gambar grid wajah
      drawConnectors(canvasCtx, landmarks, FACEMESH_TESSELATION, {
        color: "#C0C0C070",
        lineWidth: 1,
      });
      drawConnectors(canvasCtx, landmarks, FACEMESH_RIGHT_EYE, {
        color: "#FF3030",
        lineWidth: 1,
      });
      drawConnectors(canvasCtx, landmarks, FACEMESH_LEFT_EYE, {
        color: "#30FF30",
        lineWidth: 1,
      });
      drawConnectors(canvasCtx, landmarks, FACEMESH_FACE_OVAL, {
        color: "#E0E0E0",
        lineWidth: 1,
      });
      drawLandmarks(canvasCtx, landmarks, {
        color: "#E0E0E0",
        radius: 0,
      });

      // Deteksi apakah mulut terbuka
      const upperLip = landmarks[13]; // Bibir atas
      const lowerLip = landmarks[14]; // Bibir bawah
      const leftLip = landmarks[78];
      const rightLip = landmarks[308];
      const isMouthOpen = detectMouthOpen(
        upperLip,
        lowerLip,
        leftLip,
        rightLip
      );

      if (isMouthOpen && !mouthOpenDetected) {
        mouthOpenDetected = true; // Tandai bahwa mulut terbuka sudah terdeteksi
        console.log("Mulut terbuka! Silakan kedipkan mata.");
      }

      // Deteksi apakah mata berkedip
      if (mouthOpenDetected && !eyeBlinkDetected) {
        const leftEye = landmarks.slice(362, 368); // Landmark mata kiri
        const rightEye = landmarks.slice(33, 39); // Landmark mata kanan
        const isEyeBlink = detectEyeBlink(leftEye, rightEye);

        if (isEyeBlink) {
          eyeBlinkDetected = true; // Tandai bahwa kedipan mata sudah terdeteksi
          console.log("Kedip mata terdeteksi! Screenshot diambil.");
          saveScreenshot();
        }
      }
    }
  }
}

function calculateEAR(eye) {
  const vertical1 = Math.hypot(eye[1].x - eye[5].x, eye[1].y - eye[5].y);
  const vertical2 = Math.hypot(eye[2].x - eye[4].x, eye[2].y - eye[4].y);
  const horizontal = Math.hypot(eye[0].x - eye[3].x, eye[0].y - eye[3].y);
  return (vertical1 + vertical2) / (2.0 * horizontal);
}

function detectEyeBlink(leftEye, rightEye) {
  const leftEAR = calculateEAR(leftEye);
  const rightEAR = calculateEAR(rightEye);
  const EAR = (leftEAR + rightEAR) / 2;

  console.log("EAR:", EAR); // Debugging nilai EAR
  return EAR < 0.3; // Cek dengan threshold 0.3
}

function detectMouthOpen(upperLip, lowerLip, leftLip, rightLip) {
  const verticalDistance = Math.hypot(
    lowerLip.x - upperLip.x,
    lowerLip.y - upperLip.y
  );
  const horizontalDistance = Math.hypot(
    rightLip.x - leftLip.x,
    rightLip.y - leftLip.y
  );
  const MAR = verticalDistance / horizontalDistance;

  const currentTime = Date.now();
  const mouthOpenDetected = MAR > 0.5; // Ubah threshold jika perlu

  if (mouthOpenDetected && currentTime - lastMouthOpenTime > 500) {
    lastMouthOpenTime = currentTime;
    return true;
  }
  return false;
}

function alertMouthOpen() {
  alert("Buka mulutmu! Mulut terbuka terdeteksi.");
}

async function saveScreenshot() {
  const screenshotCanvas = document.createElement("canvas");
  screenshotCanvas.width = videoElement.videoWidth;
  screenshotCanvas.height = videoElement.videoHeight;
  const screenshotCtx = screenshotCanvas.getContext("2d");
  screenshotCtx.drawImage(
    videoElement,
    0,
    0,
    screenshotCanvas.width,
    screenshotCanvas.height
  );

  const link = document.createElement("a");
  link.href = screenshotCanvas.toDataURL("image/png");
  link.download = "screenshot.png";
  await link.click(); // Tambahkan await untuk memastikan link diklik
}
