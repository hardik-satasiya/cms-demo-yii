SELECT COUNT(DISTINCT jobs.id) as CNT
FROM jobs
LEFT JOIN company ON jobs.company_id = company.id
LEFT JOIN jobs_courses ON jobs.id = jobs_courses.job_id JOIN jobs_courses AS JC ON jobs_courses.job_id = JC.job_id LEFT JOIN courses ON jobs_courses.course_id=courses.id WHERE company.test_account = 'N'
AND company.status IN('A','N') AND jobs.status IN (2) AND ( jobs.campus_type IN (1,2,3,4)) AND ( jobs.jobs_title LIKE '%new%' OR
jobs.key_skills LIKE '%new%' OR
company.name_of_company LIKE '%new%' OR
jobs.keywords LIKE '%new%' OR
jobs.jobs_description LIKE '%new%' OR
jobs.jobs_summary LIKE '%new%' OR
( MATCH(jobs_title) AGAINST ('new' IN BOOLEAN MODE) ) OR ( MATCH(key_skills) AGAINST ('new' IN BOOLEAN MODE) ) OR ( MATCH(keywords) AGAINST ('new' IN BOOLEAN MODE) ) OR ( MATCH(jobs_summary) AGAINST ('new' IN BOOLEAN MODE) ) ) AND courses.id = '4' AND JC.course_id = '9'