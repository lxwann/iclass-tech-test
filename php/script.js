const table = document.getElementById('managers-table');
const rows = table.getElementsByTagName('tr');

for (let i = 1; i < rows.length; i++) {
    const row = rows[i];
    row.addEventListener('mouseover', () => {
        const department = row.cells[0].innerText;
        const employeesCount = row.cells[3].innerText;
        const employeesSalary = row.cells[2].innerText;
        alert(`Department: ${department}\nEmployees: ${employeesCount}\nTotal Salary: $${employeesSalary}`);
    });
}

