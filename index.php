<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Madimi+One&display=swap');
    *{
      font-family: Madimi One;
      text-align: center;
      margin:0;
      padding:0;
      box-sizing: border-box;
    }
    table{
      width:100%;
    }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    tr:nth-child(even){
      background-color:gray;
    }
    th{background-color:gray;}
    <title>Fruit Basket</title>
    th, td {
      padding: 5px;
    }
  </style>
</head>
<body>
  <h1>Fruit Basket</h1>
  <table id="basketTable">
    <thead>
      <tr>
        <th>Student Number</th>
        <th>Student Name</th>
        <th>Quiz1</th>
        <th>Quiz2</th>
        <th>Quiz3</th>
        <th>Quiz4</th>
        <th>Quiz5</th>
        <th>Ave.quiz</th>

      </tr>
    </thead>
    <tbody>
    <?php
      $xmlString = file_get_contents("students.xml");
      $xmlDoc = new DOMDocument();
      $xmlDoc->loadXML($xmlString);

      $students = $xmlDoc->getElementsByTagName("student");

      foreach ($students as $student) {
          $studentNumber = $student->getElementsByTagName("studentNumber")->item(0)->textContent;
          $studentName = $student->getElementsByTagName("studentName")->item(0)->textContent;

          echo "<tr>";
          echo "<td>$studentNumber</td>";
          echo "<td>$studentName</td>";

          $quizScores = [];
          $totalQuizScore = 0;
          $quizCount = 0;

          $quizzes = $student->getElementsByTagName("quiz");
          for ($j = 0; $j < $quizzes->length; $j++) {
              $quiz = $quizzes->item($j);
              $quizScore = $quiz->textContent;

              echo "<td>$quizScore</td>";

              // Update the total quiz score and count
              $totalQuizScore += intval($quizScore);
              $quizCount++;
          }

          // Calculate the average quiz score
          $averageQuizScore = $quizCount > 0 ? $totalQuizScore / $quizCount : 0;
          echo "<td>$averageQuizScore</td>";

          echo "</tr>";
      }
    ?>

    </tbody>
  </table>
</body>
</html>