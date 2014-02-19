<?php
/* This file is part of YouXuse
 * 
 * <YouXuse - web application to sell & buy componnents of tecnology>
 * Copyright (C) <2013>  <Filipe Marques> <eagle.software3@gmail.com>
 *
 * YouXuse is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * YouXuse is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * For full reading of the license see the folder "license" 
 * 
 */
session_name("YouXuse");

require_once("process/functions.php");

// check if it has session created, if yes search for the strings of country, if no do nothing
if (session_start()){
	check_session_idiom();
}

if (!isset($_GET['lang'])) {
	if (!isset($_COOKIE['lang'])){
		require ("lang/uk.php");
	} else {
		//idiom_geoip();
		idiom_without_session($_COOKIE['lang']);
	}
} else {
	$la = mysql_escape_string(htmlspecialchars(htmlentities(trim($_GET['lang'])), ENT_QUOTES));
	idiom_without_session($la);
	setcookie("lang", $la, time()+3600, "youxuse.com");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo LABEL_PAGE_TITLE_TEXT; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="resources/css/bootstrap.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link href="resources/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="../assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="resources/img/youxuse-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="resources/img/youxuse-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="resources/img/youxuse-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="resources/img/youxuse-icon-57.png">
        <link rel="shortcut icon" href="resources/img/youxuse-icon.png">
		<?php
			require_once("analytic.php");
		?>
    </head>

    <body>          

        <?php include ("hf/header.php"); ?>

        <div>
			<?php 
				require("pub.php");
			?>
		</div>
			
		<hr>
        
        <div class="container">

            <p class="lead">
                YouXuse&trade; Code of Conduct v2.0<br><br>
                <strong>Community</strong><br><br>

                We want a productive, happy and agile community that can welcome new ideas in a complex field, 
                improve every process every year, and foster collaboration between groups with very different needs, 
                interests and skills.<br><br>

                We gain strength from diversity, and actively seek participation from those who enhance it. 
                This code of conduct exists to ensure that diverse groups collaborate to mutual advantage and enjoyment. 
                We will challenge prejudice that could jeopardise the participation of any person in the project.<br><br>

                The Code of Conduct governs how we behave in public or in private whenever the project will be judged by our actions. 
                We expect it to be honored by everyone who represents the project officially or informally, claims affiliation with the project, 
                or participates directly.<br>
                We strive to:<br><br>

                <strong>Be considerate</strong><br><br>

                Our work will be used by other people, and we in turn will depend on the work of others. Any decision we take will affect users 
                and colleagues, and we should consider them when making decisions.<br><br>

                <strong>Be respectful</strong><br><br>

                Disagreement is no excuse for poor manners. We work together to resolve conflict, assume good intentions and do our best to act 
                in an empathic fashion. We don't allow frustration to turn into a personal attack. A community where people feel uncomfortable or 
                threatened is not a productive one.<br><br>

                Take responsibility for our words and our actions<br><br>

                We can all make mistakes; when we do, we take responsibility for them. If someone has been harmed or offended, we listen carefully 
                and respectfully, and work to right the wrong.<br><br>

                <strong>Be collaborative</strong><br><br>

                What we produce is a complex whole made of many parts, it is the sum of many dreams. Collaboration between teams that each have their 
                own goal and vision is essential; for the whole to be more than the sum of its parts, each part must make an effort to understand the whole.<br><br>

                Collaboration reduces redundancy and improves the quality of our work. 
                Internally and externally, we celebrate good collaboration. 
                Wherever possible, we work closely with upstream projects and others in the free software community to coordinate our efforts. We prefer to work 
                transparently and involve interested parties as early as possible.<br><br>

                <strong>Value decisiveness, clarity and consensus</strong><br><br>

                Disagreements, social and technical, are normal, but we do not allow them to persist and fester leaving others uncertain of the agreed direction.<br><br>

                We expect participants in the project to resolve disagreements constructively. 
                When they cannot, we escalate the matter to structures with designated leaders to arbitrate and provide clarity and direction.<br><br>

                <strong>Ask for help when unsure</strong><br><br>

                Nobody is expected to be perfect in this community. Asking questions early avoids many problems later, so questions are encouraged, though they may 
                be directed to the appropriate forum. Those who are asked should be responsive and helpful.<br><br>

                <strong>Step down considerately</strong><br><br>

                When somebody leaves or disengages from the project, we ask that they do so in a way that minimises disruption to the project. 
                They should tell people they are leaving and take the proper steps to ensure that others can pick up where they left off.<br><br>

                <strong>Leadership, authority and responsibility</strong><br><br>

                We all lead by example, in debate and in action. We encourage new participants to feel empowered to lead, to take action, and to experiment when they 
                feel innovation could improve the project. Leadership can be exercised by anyone simply by taking action, there is no need to wait for recognition when 
                the opportunity to lead presents itself.<br><br>

                <strong>Delegation from the top</strong><br><br>

                Responsibility for the project starts with the "self-apointed benevolent dictator for life", who delegates specific responsibilities and the corresponding authority to a series 
                of teams, councils and individuals, starting with the Community Council ("CC"). That Council or its delegated representative will arbitrate in any dispute.

                We are a meritocracy; we delegate decision making, governance and leadership from senior bodies to the most able and engaged candidates.<br><br>

                <strong>Support for delegation is measured</strong><br><br>

                Nominations to the boards and councils are at the discretion of the Community Council, however the Community Council will seek the input of the community 
                before confirming appointments.

                Leadership is not an award, right, or title; it is a privilege, a responsibility and a mandate. A leader will only retain their authority as long as they 
                retain the support of those who delegated that authority to them.<br><br>

                <strong>We value discussion, data and decisiveness</strong><br><br>

                We gather opinions, data and commitments from concerned parties before taking a decision. We expect leaders to help teams come to a decision in a reasonable 
                time, to seek guidance or be willing to take the decision themselves when consensus is lacking, and to take responsibility for implementation.<br><br>

                The poorest decision of all is no decision: clarity of direction has value in itself. Sometimes all the data are not available, or consensus is elusive. 
                A decision must still be made. There is no guarantee of a perfect decision every time - we prefer to err, learn, and err less in future than to postpone action indefinitely.<br><br>

                We recognise that the project works better when we trust the teams closest to a problem to make the decision for the project. If we learn of a decision 
                that we disagree with, we can engage the relevant team to find common ground, and failing that, we have a governance structure that can review the decision. 
                Ultimately, if a decision has been taken by the people responsible for it, and is supported by the project governance, it will stand. 
                None of us expects to agree with every decision, and we value highly the willingness to stand by the project and help it deliver even on the occasions 
                when we ourselves may prefer a different route.<br><br>

                <strong>Open meritocracy</strong><br><br>

                We invite anybody, from any company, to participate in any aspect of the project. 
                Our community is open, and any responsibility can be carried by any contributor who demonstrates the required capacity and competence.<br><br>

                <strong>Teamwork</strong><br><br>

                A leader's foremost goal is the success of the team.<br><br>

                "A virtuoso is judged by their actions; a leader is judged by the actions of their team." 
                A leader knows when to act and when to step back. They know when to delegate work, and when to take it upon themselves.<br><br>

                <strong>Credit</strong><br><br>

                A good leader does not seek the limelight, but celebrates team members for the work they do. Leaders may be more visible than members of the team, 
                good ones use that visibility to highlight the great work of others.<br><br>

                <strong>Courage and considerateness</strong><br><br>

                Leadership occasionally requires bold decisions that will not be widely understood, consensual or popular. 
                We value the courage to take such decisions, because they enable the project as a whole to move forward faster than we could if we required complete consensus. 
                Nevertheless, boldness demands considerateness; take bold decisions, but do so mindful of the challenges they present for others, and work to 
                soften the impact of those decisions on them. Communicating changes and their reasoning clearly and early on is as important as the implementation of the change itself.<br><br>

                <strong>Conflicts of interest</strong><br><br>

                We expect leaders to be aware when they are conflicted due to employment or other projects they are involved in, and abstain or delegate decisions that may be seen to be 
                self-interested. We expect that everyone who participates in the project does so with the goal of making life better for its users.<br><br>

                When in doubt, ask for a second opinion. Perceived conflicts of interest are important to address; as a leader, act to ensure that decisions are credible even if they must 
                occasionally be unpopular, difficult or favourable to the interests of one group over another.<br><br>

                This Code is not exhaustive or complete. It is not a rulebook; it serves to distill our common understanding of a collaborative, shared environment and goals. 
                We expect it to be followed in spirit as much as in the letter.<br><br>
            </p>	
            <hr>

            <?php echo LABEL_CONDUTA_TEXT1; ?> Creative Commons Attribution-Share Alike 3.0 license.<br>
            <?php echo LABEL_CONDUTA_TEXT2; ?> Creative Commons Attribution-Share Alike 3.0 license.<br>
            <?php echo LABEL_CONDUTA_TEXT3; ?> <a href="http://www.ubuntu.com/about/about-ubuntu/conduct"><?php echo LABEL_CONDUTA_TEXT4; ?></a>.<br>
            <?php echo LABEL_CONDUTA_TEXT5; ?> <a href="http://www.ubuntu.com/"><?php echo LABEL_CONDUTA_TEXT6; ?></a> !

			<div>
				<?php 
					require("pub.php");
				?>
			</div>

            <?php include ("hf/footer.php"); ?>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-transition.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-alert.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-scrollspy.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-tab.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-tooltip.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-popover.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-button.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-collapse.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-carousel.js"></script>
        <script type="text/javascript" src="resources/js/bootstrap-typeahead.js"></script>

    </body>
</html>
