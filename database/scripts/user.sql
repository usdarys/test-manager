SELECT 
u.id
,u.first_name
,u.last_name
,u.email
,t.name
,r.name
FROM users u 
LEFT JOIN teams t ON u.team_id = t.id
LEFT JOIN role_user ru ON u.id = ru.user_id
LEFT JOIN roles r ON ru.role_id = r.id 
ORDER BY u.id
;