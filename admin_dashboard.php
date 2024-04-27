<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eMATADAN | Admin</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <link rel="icon" href="eMATADAN.png" type="image/icon type">
</head>
<body>  
    <div class="header">
        <div class="logo">
            <img src="eMATADAN.png" height="100dvh" width="100dvw">
            eMATADAN
        </div>
        <div class="logout"><a href="?logout=true"><img src="logout.png" alt="Logout" style="height: 10dvh;"></a></div>
    </div>
    <div class="row_div">
        <div class="col_div">
            <div class="status_add">
                <div class="voting_status">
                    <div class="vote_done">Vote done : </div>
                    <div class="vote_remaining">Vote remaining : </div>
                </div>
                <div class="add_candidates">
                    <button class="add" id="add-candidates" onclick="redirectToAddCandidate()">Add Candidates</button>
                </div>
            </div>
            <div class="candidates">
                <table>
                    <tr>
                        <th>S.N.</th>
                        <th>Candidate Name</th>
                        <th>Candidate Position</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    session_start();
                    
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                        header("location: index.html");
                        exit;
                    }

                    
                    if(isset($_GET["logout"]) && $_GET["logout"] == 'true'){
                        
                        $_SESSION = array();

                        
                        session_destroy();

                        
                        header("location: index.html");
                        exit;
                    }

                    include 'fetch_candidates.php';
                    ?>
                </table>
            </div>
        </div>
        <div class="tools">
            <div>Tools</div>
            <div class="start">
                <button class="start" id="start-timer">Start</button>
            </div>
            <div class="timerdisplay" id="timer-display"></div>
            <div class="reset">
                <button class="reset">Reset</button>
            </div>
        </div>
    </div>
    <script>
        function redirectToAddCandidate() {
            window.location.href = "addcandidate.html";
        }

        const startButton = document.getElementById("start-timer");
        const timerDisplay = document.getElementById("timer-display");
        const addbutton = document.getElementById("add-candidates");

        let clickCounter = sessionStorage.getItem("startButtonClickCounter"); // Get click counter from sessionStorage
        if (!clickCounter) {
            clickCounter = 0;
        }
        if (clickCounter >= 1) {
            addbutton.disabled = true;
        }

        startButton.addEventListener("click", function(){
            clickCounter++;
            if (clickCounter === 1) {
                addbutton.disabled = true;
                sessionStorage.setItem("startButtonClickCounter", clickCounter); // Store click counter in sessionStorage
                const duration = prompt("Please enter the time duration in seconds:");
                startTimer(parseInt(duration, 10)); // Start timer with user-input duration
            }
        });

        let countdown;
        let timeInSeconds = 6; // Default time

        function startTimer(duration) {
            clearInterval(countdown);
            timeInSeconds = duration;
            displayTime(timeInSeconds);

            countdown = setInterval(() => {
                timeInSeconds--;
                displayTime(timeInSeconds);

                if (timeInSeconds <= 0) {
                    clearInterval(countdown);
                    timerDisplay.textContent = "Time's up!";
                }
            }, 1000);
        }

        function displayTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            timerDisplay.textContent = `${minutes}:${remainingSeconds.toString().padStart(2, "0")}`;
        }
    </script>
</body>
</html>
