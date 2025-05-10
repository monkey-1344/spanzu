<?php
// Question and answer
$question = "Care este capitala României?";
$answer = "București"; // The correct answer
$answerLength = mb_strlen($answer); // Length of the answer
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc de Ghicire</title>
    <style>
        .letter-box {
            display: inline-block;
            padding: 10px;
            margin: 5px;
            border: 1px solid #000;
            cursor: pointer;
            text-align: center;
            width: 30px;
            height: 30px;
        }
        .letter-box.disabled {
            background-color: #ccc;
            pointer-events: none;
        }
        .answer {
            font-size: 24px;
            margin: 20px 0;
        }
        .question {
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="question">
    <strong>Întrebare:</strong> <?php echo $question; ?>
</div>
<div class="answer" id="answer">
    <?php
    // Display underscores for each letter in the answer
    for ($i = 0; $i < $answerLength; $i++) {
        $char = mb_substr($answer, $i, 1);
        echo $char === " " ? " " : "_ ";
    }
    ?>
</div>
<div class="alphabet">
    <?php
    // Romanian alphabet
    $alphabet = "AĂÂBCDEFGHIÎJKLMNOPQRSȘTȚUVWXYZ";
    $letters = preg_split('//u', $alphabet, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($letters as $letter) {
        echo "<div class='letter-box' onclick='checkLetter(\"$letter\")'>$letter</div>";
    }
    ?>
</div>

<script>
    const answer = "<?php echo $answer; ?>";
    const answerDiv = document.getElementById("answer");

    function checkLetter(letter) {
        let updatedAnswer = "";
        let found = false;

        // Check if the letter exists in the answer
        for (let i = 0; i < answer.length; i++) {
            const currentChar = answer[i];
            if (currentChar.toUpperCase() === letter) {
                updatedAnswer += currentChar;
                found = true;
            } else if (answerDiv.textContent[i] !== "_") {
                updatedAnswer += answerDiv.textContent[i];
            } else {
                updatedAnswer += "_";
            }
        }

        // Update the answer display
        answerDiv.textContent = updatedAnswer;

        // Disable the clicked letter
        const letterBoxes = document.querySelectorAll(".letter-box");
        letterBoxes.forEach(box => {
            if (box.textContent === letter) {
                box.classList.add("disabled");
            }
        });

        // Check if the game is won
        if (!updatedAnswer.includes("_")) {
            alert("Felicitări! Ai ghicit răspunsul corect!");
        }
    }
</script>
</body>
</html>