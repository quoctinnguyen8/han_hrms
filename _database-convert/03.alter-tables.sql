ALTER TABLE employees DROP FOREIGN KEY employees_ibfk_1;
ALTER TABLE employees DROP COLUMN contract_code;
ALTER TABLE contracts ADD COLUMN employee_code VARCHAR(30) NULL COMMENT 'Mã nhân viên';
ALTER TABLE contracts
ADD CONSTRAINT fk_employee_code
FOREIGN KEY (employee_code) REFERENCES employees(employee_code);

ALTER TABLE contracts ADD COLUMN salary_detail_id INT NULL COMMENT 'ID chi tiết lương';
ALTER TABLE contracts
ADD CONSTRAINT fk_salary_detail_id
FOREIGN KEY (salary_detail_id) REFERENCES salary_details(id);