function notif($type, $msg) {
	if ($type=="success") 	{$title="Selamat !",$type="success";} else
	if ($type=="error") 	{$title="Oops...",$type="error";} else
	if ($type=="info") 		{$title="Pemberitahuan !",$type="info";} else
							{$title="Hati-Hati !",$type="warning";};
	swal($title, $msg, $type);
};

function anti_input() {
	return false;
}