ALTER VIEW `recipe_view` AS
    SELECT 
        r.*, a.author, d.diet, c.course
    FROM
        recipe AS r
		INNER JOIN diet AS d ON r.diet_id = d.id
		INNER JOIN author AS a ON r.author_id = a.id
		INNER JOIN course AS c ON r.course_id = c.id;