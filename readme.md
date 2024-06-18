API Эндпоинты
Добавление пользователя в группу
curl -X POST -d "user_id=1&group_id=2" http://localhost/public/index.php?controller=user&action=addToGroup
Удаление пользователя из группы
curl -X POST -d "user_id=1&group_id=2" http://localhost/public/index.php?controller=user&action=removeFromGroup
Список групп
curl http://localhost/public/index.php?controller=group&action=list
Конечный набор прав пользователя
curl http://localhost/public/index.php?controller=user&action=permissions&user_id=1




