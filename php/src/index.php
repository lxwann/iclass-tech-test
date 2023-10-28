<?php
$server = "127.0.0.1:13306";
$username = "root";
$password = "verysecurerootpasswordiclassTECHtessolution12345672019docker";
$database = "employees";
$port = 3306;

$conn = new mysqli($server, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "
SELECT
    e.first_name AS name,
    TIMESTAMPDIFF(YEAR, e.hire_date, CURDATE()) AS serve_for,
    e.salary,
    d.dept_name,
    e.gender,
    COUNT(*) AS employees_count,
    SUM(d.salary) AS employees_salary
FROM employees e
JOIN dept_manager m ON e.emp_no = m.emp_no
JOIN departments d ON m.dept_no = d.dept_no
GROUP BY m.emp_no, d.dept_name, e.gender
ORDER BY serve_for ASC;
";

$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <h1>Department Managers</h1>
    <table id="managers-table">
        <tr>
            <th>Department</th>
            <th>Name</th>
            <th>Salary</th>
            <th>Years Served</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='gender-" . strtolower($row['gender']) . "'>";
            echo "<td>" . $row['dept_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['salary'] . "</td>";
            echo "<td>" . $row['serve_for'] . "</td>";
            echo "</tr>";
        }
        $result->free();
        $conn->close();
        ?>
    </table>
</body>
</html>
