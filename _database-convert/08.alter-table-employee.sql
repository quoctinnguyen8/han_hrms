-- Thêm cột date_quit để đánh dấu ngày nhân viên nghỉ việc
ALTER TABLE employees
ADD COLUMN date_quit DATE NULL COMMENT 'Ngày nghỉ việc' AFTER status;

UPDATE employees
SET status = 0, date_quit = '2024-10-01'
WHERE employee_code = 'NV001';
