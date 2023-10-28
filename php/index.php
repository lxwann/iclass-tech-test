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
    d.dept_name,
    e.first_name AS name,
    TIMESTAMPDIFF(YEAR, e.hire_date, CURDATE()) AS serve_for,
    e.gender,
    COUNT(*) AS employees_count,
    SUM(s.salary) AS employees_salary
FROM employees e
JOIN dept_manager dm ON e.emp_no = dm.emp_no
JOIN departments d ON dm.dept_no = d.dept_no
LEFT JOIN dept_emp de ON e.emp_no = de.emp_no
LEFT JOIN salaries s ON e.emp_no = s.emp_no
GROUP BY d.dept_name, e.first_name, e.hire_date, e.gender
ORDER BY d.dept_name ASC, serve_for ASC;


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
            <th>Served for</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='gender-" . strtolower($row['gender']) . "'>";
            echo "<td>" . $row['dept_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['employees_salary'] . "</td>";
            echo "<td>" . $row['serve_for'] . "</td>";
            echo "</tr>";
        }
        $result->free();
        $conn->close();
        ?>
    </table>
</body>
</html>
