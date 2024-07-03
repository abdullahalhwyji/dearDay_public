const video = document.getElementById("video");
const isScreenSmall = window.matchMedia("(max-width: 700px)");
let predictedAges = [];

Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri("./models"),
  faceapi.nets.faceLandmark68Net.loadFromUri("./models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("./models"),
  faceapi.nets.faceExpressionNet.loadFromUri("./models"),
  faceapi.nets.ageGenderNet.loadFromUri("./models"),
]);

function startVideo() {
  navigator.getUserMedia(
    { video: {} },
    (stream) => (video.srcObject = stream),
    (err) => console.error(err)
  );
}

var data = {
  expression: {
    angry: 0,
    disgusted: 0,
    fearful: 0,
    happy: 0,
    neutral: 0,
    sad: 0,
    surprised: 0,
  },
  counter: {
    count: 0,
  },
  emotion: "",
};

function stop() {
  const video = document.querySelector("video");
  const mediaStream = video.srcObject;
  const tracks = mediaStream.getTracks();
  tracks[0].stop();

  const userData = new FormData();
  userData.append('angry', data.expression.angry / data.counter.count);
  userData.append('disgusted', data.expression.disgusted / data.counter.count);
  userData.append('fearful', data.expression.fearful / data.counter.count);
  userData.append('happy', data.expression.happy / data.counter.count);
  userData.append('neutral', data.expression.neutral / data.counter.count);
  userData.append('sad', data.expression.sad / data.counter.count);
  userData.append('surprised', data.expression.surprised / data.counter.count);

  console.log("Data to be sent:", userData); // Log data before sending

  fetch('../save_face_data.php', {
    method: 'POST',
    body: userData,
  })
  .then(response => response.text())
  .then(data => {
    console.log('Success:', data);
    if (confirm('Emotion data saved successfully! Press OK to continue.')) {
      window.location.href = '../interface/interface.php'; // Redirect to your desired URL
    }
  })
  .catch((error) => {
    console.error('Error:', error);
    alert('Error saving emotion data.');
  });
}






function screenResize(isScreenSmall) {
  if (isScreenSmall.matches) {
    // If media query matches
    video.style.width = "320px";
  } else {
    video.style.width = "500px";
  }
}
startVideo();
screenResize(isScreenSmall); // Call listener function at run time
isScreenSmall.addListener(screenResize);

video.addEventListener("playing", () => {
  console.log("playing called");
  const canvas = faceapi.createCanvasFromMedia(video);
  let container = document.querySelector(".container");
  container.append(canvas);

  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);

  setInterval(async () => {
    const detections = await faceapi
      .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
      .withFaceLandmarks()
      .withFaceExpressions()
      .withAgeAndGender();

    const resizedDetections = faceapi.resizeResults(detections, displaySize);
    console.log(resizedDetections);

    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

    faceapi.draw.drawDetections(canvas, resizedDetections);
    faceapi.draw.drawFaceExpressions(canvas, resizedDetections);
    if (resizedDetections && Object.keys(resizedDetections).length > 0) {
      const age = resizedDetections.age;
      const interpolatedAge = interpolateAgePredictions(age);
      const gender = resizedDetections.gender;
      const expressions = resizedDetections.expressions;
      const maxValue = Math.max(...Object.values(expressions));
      const emotion = Object.keys(expressions).filter(
        (item) => expressions[item] === maxValue
      );
      data.counter.count += 1;
      data.expression.angry += expressions.angry;
      data.expression.disgusted += expressions.disgusted;
      data.expression.fearful += expressions.fearful;
      data.expression.happy += expressions.happy;
      data.expression.neutral += expressions.neutral;
      data.expression.sad += expressions.sad;
      data.expression.surprised += expressions.surprised;

      document.getElementById("age").innerText = `Age - ${interpolatedAge}`;
      document.getElementById("gender").innerText = `Gender - ${gender}`;
      document.getElementById("emotion").innerText = `Emotion - ${emotion[0]}`;
    }
  }, 10);
});

function interpolateAgePredictions(age) {
  predictedAges = [age].concat(predictedAges).slice(0, 10);
  const avgPredictedAge =
    predictedAges.reduce((total, a) => total + a) / predictedAges.length;
  return avgPredictedAge;
}
