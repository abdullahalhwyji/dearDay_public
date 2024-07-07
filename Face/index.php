<!DOCTYPE html>
<html lang="en">
  <?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
   
      header("Location: ../login.php");
      exit();
  }
  ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Face recognition App</title>
  <!-- <link rel="stylesheet" href="../css/style_face.css" /> -->
   <style>
    body {
  margin: 0px;
  padding: -100px;
  box-sizing: border-box;
  background: url('../img/1234.jpg') no-repeat center center/cover;
  width: calc(100%);
  
}

canvas {
  position: absolute;
}
.container {
  display: flex;
  width: 100%;
  justify-content: center;
  align-items: center;
}
.result-container {
  display: flex;
  width: s%;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  
}
.result-container > div {
  font-size: 1.3rem;
  padding: 0.5rem;
  color: white;
  text-transform: capitalize;
  width: 18vw;
  text-align: center;
}

#age, #emotion, #gender {
  width: 200px;
  height: 40px;
  border-radius: 5px;
  margin-bottom: 10px; /* Increased spacing between divs */
  transition: transform 0.3s ease, margin 0.3s ease; /* Added transition for both transform and margin */
}

/* Styles for individual divs */
#age {
  background: #ff6b6b; /* Vibrant red */
  display: none;
}

#emotion {
  background: #4E1E1A; /* Bright orange */
  margin-top: 20px; /* Adjusted margin to create space */
}

#gender {
  background: #363C18; /* Soft blue */
}

video {
  width: 100%;
}

header {
  background: #673ab7; /* Deep purple */
  color: white;
  font-size: 1.5rem;
  padding: 1rem;
  height: 60px;
  position: sticky;
  top: 0;
  z-index: 1000;
  width: 100%;
  text-align: center;
}

/* Base button styles */
button {
  font-weight: bold;
  outline: none;
  width: 200px;
  height: 40px;
  background-color: #45a049;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  
}

/* Hover effect */
button:hover {
  background-color: #7A884C;
}

/* Focus effect */
button:focus {
  box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2);
}

/* Add hover effect to divs */
#age:hover, #emotion:hover, #gender:hover {
  transform: scale(1.1); /* Scale up on hover */
}

#bb {
      position: absolute;
      top: 20px;
      left: 20px;
      background-color: transparent; /* Green background */
      color: white; /* White color */
      padding: 20px; /* Increase padding */
      border-radius: 50%; /* Rounded borders */
      border: none; /* Remove borders */
      cursor: pointer; /* Pointer/hand icon on hover */
     
    }

    #bb i {
      font-size: 30px; /* Increase icon size */
    }



   </style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<button class="icon-button" id="bb" onclick="goBack()">
    <i class="fas fa-arrow-left"></i>
  </button>
  
  <div class="container">
    <video id="video" height="500" width="500" autoplay muted></video>
  </div>

  <div class="result-container">
    <div id="emotion">Emotion</div>
    <div id="gender">Gender</div>
    <div id="age">Age</div>
    <button onclick="stop()">Save Data</button>
  </div>

  <script src="./js/face-api.min.js"></script>
  <!-- <script src="./js/main.js"></script> -->
</body>

<script>
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

  fetch('save_face_data.php', {
    method: 'POST',
    body: userData,
  })
  .then(response => response.text())
  .then(data => {
    console.log('Success:', data);
    alert('Emotion data saved successfully!');
    // No window location change, keep the window open
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


function goBack() {
      window.history.back();
    }

</script>

</html>