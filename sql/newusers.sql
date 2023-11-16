INSERT INTO usuarios  (usuario_id, password, nombre) VALUES
(1, 'password1', 'John Doe'),
(2, 'password2', 'Jane Smith'),
(3, 'password3', 'Alice Johnson'),
(4, 'password4', 'Bob Williams'),
(5, 'password5', 'Eva Davis'),
(6, 'password6', 'Chris Brown'),
(7, 'password7', 'Mia Turner'),
(8, 'password8', 'Samuel White'),
(9, 'password9', 'Sophia Lee'),
(10, 'password10', 'Daniel Moore');

SELECT usuario_id, password FROM usuarios WHERE usuario_id = '5' AND password = 'password5';

