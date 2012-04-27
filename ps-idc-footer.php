<!-- footer -->
<p>
<DIV id="block-bar"></DIV>
<DIV id="footer">
<DIV id="foot-left">
	<A href="http://www.bcbis.sc.gov/bcbis/"><IMG src="/images/bcbis-anim.gif" height="33" width="122" border=1 vspace=4 title="Developed by BCB Information Services"></A>
<BR>
<A href="mailto:DSmoak@bcbis.sc.gov">Email for Web Site Help</A>
</DIV>
	<DIV id="foot-center">
Procurement Services<BR>
1201 Main St. , Suite 600<BR>
Columbia, SC 29201<BR>
(803) 737-0600 | FAX:(803) 737-0639<BR>
Updated: <?echo date( "D m/d/Y", filemtime( $PATH_TRANSLATED ))?>
	</DIV>
	<DIV id="foot-right"><?
//		echo EncodeEmail("DSmoak@bcbis.sc.gov?subject=$title", "Comments?");
		$this_counter = substr(basename($_SERVER['PHP_SELF']), 0, -5).".dat";
		if (@is_file("/usr/local/etc/Counter/data/".$this_counter))
		{
			echo "<IMG SRC=\"/cgi-bin/Count.cgi?df=".$this_counter."&dd=B&ft=2&frgb=ForestGreen\" BORDER=0 ALT=\"Counter\">";
		}
		?>
	</DIV>
</DIV>
</BODY>
</HTML>
