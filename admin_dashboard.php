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
        <div class="logout">Logout button</div>
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
                    <?php include "fetch_candidates.php"; ?>
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

        startButton.addEventListener("click", function(){
            this.disabled = true;
            addbutton.disabled = true;
        })

        let countdown;
        let timeInSeconds = 6; 

        function startTimer() {
            clearInterval(countdown);
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

        startButton.addEventListener("click", startTimer);

    </script>
</body>
</html>
