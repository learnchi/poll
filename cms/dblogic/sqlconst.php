<?php
class SqlConst {
	// SQL theme
	const SQL_TM_01 = 'SELECT * FROM theme';
	const SQL_TM_02 = ' WHERE theme_id = ?';
	const SQL_TM_03 = ' ORDER BY deadline DESC, theme_id DESC LIMIT ?';

	// SQL candidate vote
	const SQL_CV_01 = 'SELECT candidate_id,candidate_name,candidate_img, candidate_explanation,(select count(vote_id) from vote where theme_id = ? and candidate_id = candidate.candidate_id) as cnt from candidate where  theme_id = ? order by  candidate_id';
	const SQL_CV_02 = 'SELECT c.candidate_id,c.candidate_name,c.candidate_img, c.candidate_explanation, v.cnt from candidate c, (select theme_id, candidate_id, count(vote_id) as cnt from vote group by theme_id,candidate_id) v where c.theme_id = ? and c.theme_id = v.theme_id and c.candidate_id = v.candidate_id order by v.cnt desc';

	// SQL vote
	const SQL_VT_01 = 'SELECT COUNT(vote_id) FROM vote';
	const SQL_VT_02 = ' WHERE theme_id = ? and candidate_id = ?';
	const SQL_VT_03 = 'select sum(cnt) from ( select distinct count(vote_id) as cnt from vote where theme_id = ? group by theme_id,candidate_id) A';
	const SQL_VT_04 = 'INSERT INTO vote (theme_id,candidate_id,voter) VALUES(?,?,?)';
}
?>
