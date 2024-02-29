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
                    <button class="add" onclick="redirectToAddCandidate()">Add Candidates</button>
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
                <button class="start">Start</button>
            </div>
            <div class="stop">
                <button class="stop">Stop</button>
            </div>
            <div class="reset">
                <button class="reset">Reset</button>
            </div>
        </div>
    </div>
    <script>
        function redirectToAddCandidate() {
            window.location.href = "addcandidate.html";
        }
    </script>
</body>
</html>
