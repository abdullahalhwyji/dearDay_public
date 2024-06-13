document.addEventListener('DOMContentLoaded', function () {
    // Menubar behavior
    let menubar = document.querySelector('#menu-bars');
    let navbar = document.querySelector('.navbar');
  
    menubar.onclick = () => {
        menubar.classList.toggle('fa-times');
        navbar.classList.toggle('active');
    };
  
    // Modal behavior
    function setupModal(modalId, btnId, closeClass) {
        let modal = document.getElementById(modalId);
        let btn = document.getElementById(btnId);
        let span = document.getElementsByClassName(closeClass)[0];
  
        if (btn) {
            btn.onclick = function (event) {
                event.preventDefault(); // Prevent default link action
                modal.classList.add('active');
                modal.style.display = 'flex'; // Ensure display is set to flex
            };
        }
  
        if (span) {
            span.onclick = function () {
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 500); // Match the transition duration
            };
        }
  
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 500); // Match the transition duration
            }
        };
    }
  
    setupModal('myModal', 'myBtn', 'close');
  
    // Handle emoji click and form submission
    document.querySelectorAll('.emoji button').forEach(function (button) {
        button.onclick = function () {
            let mood = this.value;
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'mood.php';
  
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'mood';
            input.value = mood;
            form.appendChild(input);
  
            document.body.appendChild(form);
            form.submit();
        };
    });
  });

 
    document.addEventListener('DOMContentLoaded', function() {
        var welcomeBtn = document.getElementById('welcome-btn');
        var originalText = welcomeBtn.innerHTML;
        var hoverText = 'logout';

        welcomeBtn.addEventListener('mouseover', function() {
            welcomeBtn.innerHTML = hoverText;
        });

        welcomeBtn.addEventListener('mouseout', function() {
            welcomeBtn.innerHTML = originalText;
        });
    });
 

  
    // Get the div elements
    var tech1Div = document.getElementById('tech1');
    var tech2Div = document.getElementById('tech2');
    var tech3Div = document.getElementById('tech3');

    // Add click event listener for tech1Div [jornal]
    tech1Div.addEventListener('click', function() {
        // Redirect to destination for tech1
        window.location.href = '../journal/journal.php';
    });

    // Add click event listener for tech2Div [real time tracking]
    tech2Div.addEventListener('click', function() {
        // Redirect to destination for tech2
        window.location.href = '../Face/index.php';
    });

    // Add click event listener for tech3Div [quiz]
    tech3Div.addEventListener('click', function() {
        // Redirect to destination for tech2
        window.location.href = '../quiz/quiz.php';
    });

