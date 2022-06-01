SELECT
tr.name
,tc.name
,trs.status
,trs.comment
,u.email
,trs.updated_at
FROM test_results trs
JOIN test_runs tr ON tr.id = trs.test_run_id
JOIN test_cases tc ON tc.id = trs.test_case_id
LEFT JOIN users u ON u.id = trs.updated_by
WHERE 
1 = 1
--trs.id = 1
;