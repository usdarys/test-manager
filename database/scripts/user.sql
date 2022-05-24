SELECT 
u.id
,u.first_name
,u.last_name
,u.email
,t.id
,t.name
,r.name
,u.deleted_at
FROM users u 
LEFT JOIN teams t ON u.team_id = t.id
LEFT JOIN role_user ru ON u.id = ru.user_id
LEFT JOIN roles r ON ru.role_id = r.id 
WHERE 
1 = 1
AND t.id = 1
--AND u.id = 10
ORDER BY u.id
;