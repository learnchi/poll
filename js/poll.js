function vote(theme, candidate) {
	$.post("cms/logic/vote.php",
			  { theme: theme, candidate: candidate },
			  function(data){
				  alert("投票しました！");
				// 得票数書き換え
				$("span#voteCnt_"+candidate).text(data['cnt']);
			  },
			  "json"
			);
}
