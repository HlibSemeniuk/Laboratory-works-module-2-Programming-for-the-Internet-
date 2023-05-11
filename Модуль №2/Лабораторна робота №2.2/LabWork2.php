<!DOCTYPE html>
<html>

<link rel="stylesheet" type="text/css" href="ButtonColor.css">
<head>
    <title>Перевірка усного рахунку</title>
</head>

<style>
    body {
        background-color: aliceblue;
    }

    .center {
        text-align: center;
        margin: auto;
    }

    #keyboard {
        text-align: center;
        margin: auto;
        border: 2px solid;
    }
    #EndSession {
        text-align: center;
        margin: auto;
    }
</style>

<body>
    <h1 class="center"> Математичний тест </h1>

    <form method="post" action="">

        <?php
        session_start();

        $input="";
        $operand1="";
        $operand2="";
        $symbol="+";
        $is_answer_correct = "???";
        $answer="???";
        $max_value = 0;

        // Збереження введегних даних
        if (isset($_SESSION['input']))
        {
            $input = $_SESSION['input']; 
        }

        // Стирання введених даних
        if(isset($_POST['erase'])) {
            $input = "";
            $input = $_SESSION['input']; 
        }

        // Введення результату
        if(isset($_POST['number'])) {
            $input = $_POST['result'];
            $input .= $_POST['number'];
            $_SESSION['input'] = $input; 
        }

        // Визначення максимального значенння
        if(isset($_POST['d1'])) {
            $_SESSION['max_value'] =  10;
        }
        
        if(isset($_POST['d2'])) {
            $_SESSION['max_value'] = 20;
        }

        if(isset($_POST['d3'])) {
            $_SESSION['max_value'] = 100;
        }

        if(isset($_POST['d4'])) {
            $_SESSION['max_value'] = 23;
        }

        // Відновлення даних з сесії
        if(isset($_SESSION['max_value'])) {
            $max_value = $_SESSION['max_value'];
        } else {
            $max_value = 0; 
        }

        if(isset($_SESSION['operand1'])) {
            $operand1 = $_SESSION['operand1'];
        } else {
            $operand1 =""; 
        }

        if(isset($_SESSION['operand2'])) {
            $operand2 = $_SESSION['operand2'];
        } else {
            $operand2 =""; 
        }

        if(isset($_SESSION['answer'])) {
            $answer = $_SESSION['answer'];
        } else {
            $answer =""; 
        }

        if(isset($_SESSION['symbol'])) {
            $symbol = $_SESSION['symbol'];
        }

        // Визначення операції
        if(isset($_POST['plus'])) {
            $symbol = "+";
        }
        if(isset($_POST['minus'])) {
            $symbol = "-";
        }
        if(isset($_POST['multiplier'])) {
            $symbol = "*";
        }

        $_SESSION['symbol'] = $symbol;

        // Визначення операндів та відповіді
        if(isset($_POST['?']) && $max_value != 0) {
            $input = "";
            $_SESSION['input'] = $input;

            $_SESSION['operand1']= rand(0, $max_value);
            $_SESSION['operand2'] = rand(0, $max_value);
            $operand1 = $_SESSION['operand1'];
            $operand2 = $_SESSION['operand2'];

            if ($symbol == "+") {
                $answer = $operand1 + $operand2;
            }
            else if ($symbol == "-") {
                $answer = $operand1 - $operand2;
            }
            else if ($symbol == "*") {
                $answer = $operand1 * $operand2;
            }
            $_SESSION['answer'] = $answer;
        }

        // Перевірка на правильність відповіді користувач
        if (isset($_POST['OK']) && $answer != "") {
            if ($answer == $input) {
                $is_answer_correct = "Вірно!";
            }
            else {
                $is_answer_correct = "Спробуй ще!";
            }
        }


        // Завершення сесії
        if (isset($_POST['End'])) {
            session_destroy();
        }
        ?>    


        <hr>
        <table class="center">
            <td><button name="d1" value="0-10">0-10</button></td>
            <td><button name="d2" value="0-20">0-20</button></td>
            <td><button name="d3" value="0-100">0-100</button></td>
            <td><button name="d4" value="0-23">0-23</button></td>
            <td><button name="plus" value="+">+</button></td>
            <td><button name="minus" value="-">-</button></td>
            <td><button name="multiplier" value="*">*</button></td>
        </table>
        </hr>


        <hr>
        <table class="center">
            <td><input type="text" name="operand1" value="<?php echo $operand1; ?>" readonly></td>
            <td><input type="text" name="symbol" value="<?php echo $symbol; ?>" readonly></td>
            <td><input type="text" name="operand2" value="<?php echo $operand2; ?>" readonly></td>
            <td>=</td>
		    <td><input type="text" name="result" value="<?php echo $input; ?>" placeholder="Введіть число" readonly></td>
            <td><button name = "?" value="?">?</button></td>
            <td><input type="text" name="answer" value="<?php echo $is_answer_correct; ?>" readonly></td>
        </table>
        </hr>


        <hr>
        <table id="keyboard">
        <tr>
            <td><button id = "b1" name="number" value="1">1</button></td>
            <td><button id = "b2" name="number" value="2">2</button></td>
            <td><button id = "b3" name="number" value="3">3</button></td>
        </tr>
        <tr>
            <td><button  id = "b4" name="number" value="4">4</button></td>
            <td><button  id = "b5" name="number" value="5">5</button></td>
            <td><button  id = "b6" name="number" value="6">6</button></td>
        </tr>
        <tr>
            <td><button  id = "b7" name="number" value="7">7</button></td>
            <td><button  id = "b8" name="number" value="8">8</button></td>
            <td><button  id = "b9" name="number" value="9">9</button></td>
        </tr>
        <tr>
            <td><button  id = "b0" name="number" value="0">0</button></td>
            <td><button  id = "erase" name="erase">C</button></td>
        </tr>
        <tr>
            <td></td>
            <td><button id = "OK" name="OK">OK</button></td>
            <td></td>
        </tr>
        </table>
        <hr/>

        <table id = "EndSession">
        <td><button name="End">Закінчити сесію</button></td>
        </table>
	</form>

    <h2>© Семенюк Гліб (ПІ-320)</h2>
</body>
</html>
