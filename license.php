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

            <h3><?php echo LABEL_LICENSE_TEXT1; ?><br></h3>

            <p class="lead">YouXuse&trade;&copy; is Copyright 2013 - 2014 of Filipe Marques.<br><br>
                Filipe Marques distributes the YouXuse&trade;&copy; source code
                under the GNU Affero General Public License, version 3 <br> ("GNU AGPLv3").<br><br>
                The full text of this licence is given below.<br><br>

                The images and icons files, including the logo, in YouXuse&trade;&copy; are copyright of Filipe Marques, and
                unlike the source code they are not licensed under the GNU AGPLv3.<br>
                Filipe Marques grants you the right to use them for testing and development
                purposes only, but not to use them in production (commercially or
                non-commercially).<br><br>

                The colors (blue + white) of YouXuse&trade;&copy; logo and youxuse.com &copy; domain and YouXuse&trade;&copy; trademark 
                are copyright of Filipe Marques, and may not be used without the prior written permission of Filipe Marques.<br><br>

                The documentation (text and images) in the wiki are licensed under the GNU Free Documentation License Version 1.3 .<br><br>

                Third-party copyright in this distribution is noted where applicable.<br><br>

                All rights not expressly granted are reserved.<br><br>
                ----------------------------------------------------------------------------------------------------------------------------------------------------------------------
                <br><br></p>

            <p class="lead">GNU AFFERO GENERAL PUBLIC LICENSE
                Version 3, 19 November 2007<br><br>

                Copyright (C) 2007 <a href="http://www.fsf.org">Free Software Foundation</a>, Inc.<br><br>
                Everyone is permitted to copy and distribute verbatim copies
                of this license document, but changing it is not allowed.<br><br>

                Preamble<br><br>

                The GNU Affero General Public License is a <a href="freeopensoft.php#freecopyleftsoftware">free, copyleft license for
                    software</a> and other kinds of works, specifically designed to ensure
                cooperation with the community in the case of network server software.<br><br>

                The licenses for most software and other practical works are designed
                to take away your freedom to share and change the works.  By contrast,
                our General Public Licenses are intended to guarantee your freedom to
                share and change all versions of a program--to make sure it remains free
                software for all its users.<br><br>

                When we speak of free software, we are referring to freedom, not
                price.  Our General Public Licenses are designed to make sure that you
                have the freedom to distribute copies of free software (and charge for
                them if you wish), that you receive source code or can get it if you
                want it, that you can change the software or use pieces of it in new
                free programs, and that you know you can do these things.<br><br>

                Developers that use our General Public Licenses protect your rights
                with two steps: (1) assert copyright on the software, and (2) offer
                you this License which gives you legal permission to copy, distribute
                and/or modify the software.<br><br>

                A secondary benefit of defending all users' freedom is that
                improvements made in alternate versions of the program, if they
                receive widespread use, become available for other developers to
                incorporate.  Many developers of free software are heartened and
                encouraged by the resulting cooperation.  However, in the case of
                software used on network servers, this result may fail to come about.
                The GNU General Public License permits making a modified version and
                letting the public access it on a server without ever releasing its
                source code to the public.<br><br>

                The GNU Affero General Public License is designed specifically to
                ensure that, in such cases, the modified source code becomes available
                to the community.  It requires the operator of a network server to
                provide the source code of the modified version running there to the
                users of that server.  Therefore, public use of a modified version, on
                a publicly accessible server, gives the public access to the source
                code of the modified version.<br><br>

                An older license, called the Affero General Public License and
                published by Affero, was designed to accomplish similar goals.  This is
                a different license, not a version of the Affero GPL, but Affero has
                released a new version of the Affero GPL which permits relicensing under
                this license.<br><br>

                The precise terms and conditions for copying, distribution and
                modification follow.<br><br>

                TERMS AND CONDITIONS<br><br>

                0. Definitions.<br><br>

                "This License" refers to version 3 of the GNU Affero General Public License.<br><br>

                "Copyright" also means copyright-like laws that apply to other kinds of
                works, such as semiconductor masks.<br><br>

                "The Program" refers to any copyrightable work licensed under this
                License.  Each licensee is addressed as "you".  "Licensees" and
                "recipients" may be individuals or organizations.<br><br>

                To "modify" a work means to copy from or adapt all or part of the work
                in a fashion requiring copyright permission, other than the making of an
                exact copy.  The resulting work is called a "modified version" of the
                earlier work or a work "based on" the earlier work.<br><br>

                A "covered work" means either the unmodified Program or a work based
                on the Program.<br><br>

                To "propagate" a work means to do anything with it that, without
                permission, would make you directly or secondarily liable for
                infringement under applicable copyright law, except executing it on a
                computer or modifying a private copy.  Propagation includes copying,
                distribution (with or without modification), making available to the
                public, and in some countries other activities as well.<br><br>

                To "convey" a work means any kind of propagation that enables other
                parties to make or receive copies.  Mere interaction with a user through
                a computer network, with no transfer of a copy, is not conveying.<br><br>

                An interactive user interface displays "Appropriate Legal Notices"
                to the extent that it includes a convenient and prominently visible
                feature that (1) displays an appropriate copyright notice, and (2)
                tells the user that there is no warranty for the work (except to the
                extent that warranties are provided), that licensees may convey the
                work under this License, and how to view a copy of this License.  If
                the interface presents a list of user commands or options, such as a
                menu, a prominent item in the list meets this criterion.<br><br>

                1. Source Code.<br><br>

                The "source code" for a work means the preferred form of the work
                for making modifications to it.  "Object code" means any non-source
                form of a work.<br><br>

                A "Standard Interface" means an interface that either is an official
                standard defined by a recognized standards body, or, in the case of
                interfaces specified for a particular programming language, one that
                is widely used among developers working in that language.<br><br>

                The "System Libraries" of an executable work include anything, other
                than the work as a whole, that (a) is included in the normal form of
                packaging a Major Component, but which is not part of that Major
                Component, and (b) serves only to enable use of the work with that
                Major Component, or to implement a Standard Interface for which an
                implementation is available to the public in source code form.  A
                "Major Component", in this context, means a major essential component
                (kernel, window system, and so on) of the specific operating system
                (if any) on which the executable work runs, or a compiler used to
                produce the work, or an object code interpreter used to run it.<br><br>

                The "Corresponding Source" for a work in object code form means all
                the source code needed to generate, install, and (for an executable
                work) run the object code and to modify the work, including scripts to
                control those activities.  However, it does not include the work's
                System Libraries, or general-purpose tools or generally available free
                programs which are used unmodified in performing those activities but
                which are not part of the work.  For example, Corresponding Source
                includes interface definition files associated with source files for
                the work, and the source code for shared libraries and dynamically
                linked subprograms that the work is specifically designed to require,
                such as by intimate data communication or control flow between those
                subprograms and other parts of the work.<br><br>

                The Corresponding Source need not include anything that users
                can regenerate automatically from other parts of the Corresponding
                Source.<br><br>

                The Corresponding Source for a work in source code form is that
                same work.<br><br>

                2. Basic Permissions.<br><br>

                All rights granted under this License are granted for the term of
                copyright on the Program, and are irrevocable provided the stated
                conditions are met.  This License explicitly affirms your unlimited
                permission to run the unmodified Program.  The output from running a
                covered work is covered by this License only if the output, given its
                content, constitutes a covered work.  This License acknowledges your
                rights of fair use or other equivalent, as provided by copyright law.<br><br>

                You may make, run and propagate covered works that you do not
                convey, without conditions so long as your license otherwise remains
                in force.  You may convey covered works to others for the sole purpose
                of having them make modifications exclusively for you, or provide you
                with facilities for running those works, provided that you comply with
                the terms of this License in conveying all material for which you do
                not control copyright.  Those thus making or running the covered works
                for you must do so exclusively on your behalf, under your direction
                and control, on terms that prohibit them from making any copies of
                your copyrighted material outside their relationship with you.<br><br>

                Conveying under any other circumstances is permitted solely under
                the conditions stated below.  Sublicensing is not allowed; section 10
                makes it unnecessary.<br><br>

                3. Protecting Users' Legal Rights From Anti-Circumvention Law.<br><br>

                No covered work shall be deemed part of an effective technological
                measure under any applicable law fulfilling obligations under article
                11 of the WIPO copyright treaty adopted on 20 December 1996, or
                similar laws prohibiting or restricting circumvention of such
                measures.<br><br>

                When you convey a covered work, you waive any legal power to forbid
                circumvention of technological measures to the extent such circumvention
                is effected by exercising rights under this License with respect to
                the covered work, and you disclaim any intention to limit operation or
                modification of the work as a means of enforcing, against the work's
                users, your or third parties' legal rights to forbid circumvention of
                technological measures.<br><br>

                4. Conveying Verbatim Copies.<br><br>

                You may convey verbatim copies of the Program's source code as you
                receive it, in any medium, provided that you conspicuously and
                appropriately publish on each copy an appropriate copyright notice;
                keep intact all notices stating that this License and any
                non-permissive terms added in accord with section 7 apply to the code;
                keep intact all notices of the absence of any warranty; and give all
                recipients a copy of this License along with the Program.<br><br>

                You may charge any price or no price for each copy that you convey,
                and you may offer support or warranty protection for a fee.<br><br>

                5. Conveying Modified Source Versions.<br><br>

                You may convey a work based on the Program, or the modifications to
                produce it from the Program, in the form of source code under the
                terms of section 4, provided that you also meet all of these conditions:<br><br>

                a) The work must carry prominent notices stating that you modified
                it, and giving a relevant date.<br><br>

                b) The work must carry prominent notices stating that it is
                released under this License and any conditions added under section
                7.  This requirement modifies the requirement in section 4 to
                "keep intact all notices".<br><br>

                c) You must license the entire work, as a whole, under this
                License to anyone who comes into possession of a copy.  This
                License will therefore apply, along with any applicable section 7
                additional terms, to the whole of the work, and all its parts,
                regardless of how they are packaged.  This License gives no
                permission to license the work in any other way, but it does not
                invalidate such permission if you have separately received it.<br><br>

                d) If the work has interactive user interfaces, each must display
                Appropriate Legal Notices; however, if the Program has interactive
                interfaces that do not display Appropriate Legal Notices, your
                work need not make them do so.<br><br>

                A compilation of a covered work with other separate and independent
                works, which are not by their nature extensions of the covered work,
                and which are not combined with it such as to form a larger program,
                in or on a volume of a storage or distribution medium, is called an
                "aggregate" if the compilation and its resulting copyright are not
                used to limit the access or legal rights of the compilation's users
                beyond what the individual works permit.  Inclusion of a covered work
                in an aggregate does not cause this License to apply to the other
                parts of the aggregate.<br><br>

                6. Conveying Non-Source Forms.<br><br>

                You may convey a covered work in object code form under the terms
                of sections 4 and 5, provided that you also convey the
                machine-readable Corresponding Source under the terms of this License,
                in one of these ways:<br><br>

                a) Convey the object code in, or embodied in, a physical product
                (including a physical distribution medium), accompanied by the
                Corresponding Source fixed on a durable physical medium
                customarily used for software interchange.<br><br>

                b) Convey the object code in, or embodied in, a physical product
                (including a physical distribution medium), accompanied by a
                written offer, valid for at least three years and valid for as
                long as you offer spare parts or customer support for that product
                model, to give anyone who possesses the object code either (1) a
                copy of the Corresponding Source for all the software in the
                product that is covered by this License, on a durable physical
                medium customarily used for software interchange, for a price no
                more than your reasonable cost of physically performing this
                conveying of source, or (2) access to copy the
                Corresponding Source from a network server at no charge.<br><br>

                c) Convey individual copies of the object code with a copy of the
                written offer to provide the Corresponding Source.  This
                alternative is allowed only occasionally and noncommercially, and
                only if you received the object code with such an offer, in accord
                with subsection 6b.<br><br>

                d) Convey the object code by offering access from a designated
                place (gratis or for a charge), and offer equivalent access to the
                Corresponding Source in the same way through the same place at no
                further charge.  You need not require recipients to copy the
                Corresponding Source along with the object code.  If the place to
                copy the object code is a network server, the Corresponding Source
                may be on a different server (operated by you or a third party)
                that supports equivalent copying facilities, provided you maintain
                clear directions next to the object code saying where to find the
                Corresponding Source.  Regardless of what server hosts the
                Corresponding Source, you remain obligated to ensure that it is
                available for as long as needed to satisfy these requirements.<br><br>

                e) Convey the object code using peer-to-peer transmission, provided
                you inform other peers where the object code and Corresponding
                Source of the work are being offered to the general public at no
                charge under subsection 6d.<br><br>

                A separable portion of the object code, whose source code is excluded
                from the Corresponding Source as a System Library, need not be
                included in conveying the object code work.<br><br>

                A "User Product" is either (1) a "consumer product", which means any
                tangible personal property which is normally used for personal, family,
                or household purposes, or (2) anything designed or sold for incorporation
                into a dwelling.  In determining whether a product is a consumer product,
                doubtful cases shall be resolved in favor of coverage.  For a particular
                product received by a particular user, "normally used" refers to a
                typical or common use of that class of product, regardless of the status
                of the particular user or of the way in which the particular user
                actually uses, or expects or is expected to use, the product.  A product
                is a consumer product regardless of whether the product has substantial
                commercial, industrial or non-consumer uses, unless such uses represent
                the only significant mode of use of the product.<br><br>

                "Installation Information" for a User Product means any methods,
                procedures, authorization keys, or other information required to install
                and execute modified versions of a covered work in that User Product from
                a modified version of its Corresponding Source.  The information must
                suffice to ensure that the continued functioning of the modified object
                code is in no case prevented or interfered with solely because
                modification has been made.<br><br>

                If you convey an object code work under this section in, or with, or
                specifically for use in, a User Product, and the conveying occurs as
                part of a transaction in which the right of possession and use of the
                User Product is transferred to the recipient in perpetuity or for a
                fixed term (regardless of how the transaction is characterized), the
                Corresponding Source conveyed under this section must be accompanied
                by the Installation Information.  But this requirement does not apply
                if neither you nor any third party retains the ability to install
                modified object code on the User Product (for example, the work has
                been installed in ROM).<br><br>

                The requirement to provide Installation Information does not include a
                requirement to continue to provide support service, warranty, or updates
                for a work that has been modified or installed by the recipient, or for
                the User Product in which it has been modified or installed.  Access to a
                network may be denied when the modification itself materially and
                adversely affects the operation of the network or violates the rules and
                protocols for communication across the network.<br><br>

                Corresponding Source conveyed, and Installation Information provided,
                in accord with this section must be in a format that is publicly
                documented (and with an implementation available to the public in
                source code form), and must require no special password or key for
                unpacking, reading or copying.<br><br>

                7. Additional Terms.<br><br>

                "Additional permissions" are terms that supplement the terms of this
                License by making exceptions from one or more of its conditions.
                Additional permissions that are applicable to the entire Program shall
                be treated as though they were included in this License, to the extent
                that they are valid under applicable law.  If additional permissions
                apply only to part of the Program, that part may be used separately
                under those permissions, but the entire Program remains governed by
                this License without regard to the additional permissions.<br><br>

                When you convey a copy of a covered work, you may at your option
                remove any additional permissions from that copy, or from any part of
                it.  (Additional permissions may be written to require their own
                removal in certain cases when you modify the work.)  You may place
                additional permissions on material, added by you to a covered work,
                for which you have or can give appropriate copyright permission.<br><br>

                Notwithstanding any other provision of this License, for material you
                add to a covered work, you may (if authorized by the copyright holders of
                that material) supplement the terms of this License with terms:<br><br>

                a) Disclaiming warranty or limiting liability differently from the
                terms of sections 15 and 16 of this License; or<br><br>

                b) Requiring preservation of specified reasonable legal notices or
                author attributions in that material or in the Appropriate Legal
                Notices displayed by works containing it; or<br><br>

                c) Prohibiting misrepresentation of the origin of that material, or
                requiring that modified versions of such material be marked in
                reasonable ways as different from the original version; or<br><br>

                d) Limiting the use for publicity purposes of names of licensors or
                authors of the material; or<br><br>

                e) Declining to grant rights under trademark law for use of some
                trade names, trademarks, or service marks; or<br><br>

                f) Requiring indemnification of licensors and authors of that
                material by anyone who conveys the material (or modified versions of
                it) with contractual assumptions of liability to the recipient, for
                any liability that these contractual assumptions directly impose on
                those licensors and authors.<br><br>

                All other non-permissive additional terms are considered "further
                restrictions" within the meaning of section 10.  If the Program as you
                received it, or any part of it, contains a notice stating that it is
                governed by this License along with a term that is a further
                restriction, you may remove that term.  If a license document contains
                a further restriction but permits relicensing or conveying under this
                License, you may add to a covered work material governed by the terms
                of that license document, provided that the further restriction does
                not survive such relicensing or conveying.<br><br>

                If you add terms to a covered work in accord with this section, you
                must place, in the relevant source files, a statement of the
                additional terms that apply to those files, or a notice indicating
                where to find the applicable terms.<br><br>

                Additional terms, permissive or non-permissive, may be stated in the
                form of a separately written license, or stated as exceptions;
                the above requirements apply either way.<br><br>

                8. Termination.<br><br>

                You may not propagate or modify a covered work except as expressly
                provided under this License.  Any attempt otherwise to propagate or
                modify it is void, and will automatically terminate your rights under
                this License (including any patent licenses granted under the third
                paragraph of section 11).<br><br>

                However, if you cease all violation of this License, then your
                license from a particular copyright holder is reinstated (a)
                provisionally, unless and until the copyright holder explicitly and
                finally terminates your license, and (b) permanently, if the copyright
                holder fails to notify you of the violation by some reasonable means
                prior to 60 days after the cessation.<br><br>

                Moreover, your license from a particular copyright holder is
                reinstated permanently if the copyright holder notifies you of the
                violation by some reasonable means, this is the first time you have
                received notice of violation of this License (for any work) from that
                copyright holder, and you cure the violation prior to 30 days after
                your receipt of the notice.<br><br>

                Termination of your rights under this section does not terminate the
                licenses of parties who have received copies or rights from you under
                this License.  If your rights have been terminated and not permanently
                reinstated, you do not qualify to receive new licenses for the same
                material under section 10.<br><br>

                9. Acceptance Not Required for Having Copies.<br><br>

                You are not required to accept this License in order to receive or
                run a copy of the Program.  Ancillary propagation of a covered work
                occurring solely as a consequence of using peer-to-peer transmission
                to receive a copy likewise does not require acceptance.  However,
                nothing other than this License grants you permission to propagate or
                modify any covered work.  These actions infringe copyright if you do
                not accept this License.  Therefore, by modifying or propagating a
                covered work, you indicate your acceptance of this License to do so.<br><br>

                10. Automatic Licensing of Downstream Recipients.<br><br>

                Each time you convey a covered work, the recipient automatically
                receives a license from the original licensors, to run, modify and
                propagate that work, subject to this License.  You are not responsible
                for enforcing compliance by third parties with this License.<br><br>

                An "entity transaction" is a transaction transferring control of an
                organization, or substantially all assets of one, or subdividing an
                organization, or merging organizations.  If propagation of a covered
                work results from an entity transaction, each party to that
                transaction who receives a copy of the work also receives whatever
                licenses to the work the party's predecessor in interest had or could
                give under the previous paragraph, plus a right to possession of the
                Corresponding Source of the work from the predecessor in interest, if
                the predecessor has it or can get it with reasonable efforts.<br><br>

                You may not impose any further restrictions on the exercise of the
                rights granted or affirmed under this License.  For example, you may
                not impose a license fee, royalty, or other charge for exercise of
                rights granted under this License, and you may not initiate litigation
                (including a cross-claim or counterclaim in a lawsuit) alleging that
                any patent claim is infringed by making, using, selling, offering for
                sale, or importing the Program or any portion of it.<br><br>

                11. Patents.<br><br>

                A "contributor" is a copyright holder who authorizes use under this
                License of the Program or a work on which the Program is based.  The
                work thus licensed is called the contributor's "contributor version".<br><br>

                A contributor's "essential patent claims" are all patent claims
                owned or controlled by the contributor, whether already acquired or
                hereafter acquired, that would be infringed by some manner, permitted
                by this License, of making, using, or selling its contributor version,
                but do not include claims that would be infringed only as a
                consequence of further modification of the contributor version.  For
                purposes of this definition, "control" includes the right to grant
                patent sublicenses in a manner consistent with the requirements of
                this License.<br><br>

                Each contributor grants you a non-exclusive, worldwide, royalty-free
                patent license under the contributor's essential patent claims, to
                make, use, sell, offer for sale, import and otherwise run, modify and
                propagate the contents of its contributor version.<br><br>

                In the following three paragraphs, a "patent license" is any express
                agreement or commitment, however denominated, not to enforce a patent
                (such as an express permission to practice a patent or covenant not to
                sue for patent infringement).  To "grant" such a patent license to a
                party means to make such an agreement or commitment not to enforce a
                patent against the party.<br><br>

                If you convey a covered work, knowingly relying on a patent license,
                and the Corresponding Source of the work is not available for anyone
                to copy, free of charge and under the terms of this License, through a
                publicly available network server or other readily accessible means,
                then you must either (1) cause the Corresponding Source to be so
                available, or (2) arrange to deprive yourself of the benefit of the
                patent license for this particular work, or (3) arrange, in a manner
                consistent with the requirements of this License, to extend the patent
                license to downstream recipients.  "Knowingly relying" means you have
                actual knowledge that, but for the patent license, your conveying the
                covered work in a country, or your recipient's use of the covered work
                in a country, would infringe one or more identifiable patents in that
                country that you have reason to believe are valid.<br><br>

                If, pursuant to or in connection with a single transaction or
                arrangement, you convey, or propagate by procuring conveyance of, a
                covered work, and grant a patent license to some of the parties
                receiving the covered work authorizing them to use, propagate, modify
                or convey a specific copy of the covered work, then the patent license
                you grant is automatically extended to all recipients of the covered
                work and works based on it.<br><br>

                A patent license is "discriminatory" if it does not include within
                the scope of its coverage, prohibits the exercise of, or is
                conditioned on the non-exercise of one or more of the rights that are
                specifically granted under this License.  You may not convey a covered
                work if you are a party to an arrangement with a third party that is
                in the business of distributing software, under which you make payment
                to the third party based on the extent of your activity of conveying
                the work, and under which the third party grants, to any of the
                parties who would receive the covered work from you, a discriminatory
                patent license (a) in connection with copies of the covered work
                conveyed by you (or copies made from those copies), or (b) primarily
                for and in connection with specific products or compilations that
                contain the covered work, unless you entered into that arrangement,
                or that patent license was granted, prior to 28 March 2007.<br><br>

                Nothing in this License shall be construed as excluding or limiting
                any implied license or other defenses to infringement that may
                otherwise be available to you under applicable patent law.<br><br>

                12. No Surrender of Others' Freedom.<br><br>

                If conditions are imposed on you (whether by court order, agreement or
                otherwise) that contradict the conditions of this License, they do not
                excuse you from the conditions of this License.  If you cannot convey a
                covered work so as to satisfy simultaneously your obligations under this
                License and any other pertinent obligations, then as a consequence you may
                not convey it at all.  For example, if you agree to terms that obligate you
                to collect a royalty for further conveying from those to whom you convey
                the Program, the only way you could satisfy both those terms and this
                License would be to refrain entirely from conveying the Program.<br><br>

                13. Remote Network Interaction; Use with the GNU General Public License.<br><br>

                Notwithstanding any other provision of this License, if you modify the
                Program, your modified version must prominently offer all users
                interacting with it remotely through a computer network (if your version
                supports such interaction) an opportunity to receive the Corresponding
                Source of your version by providing access to the Corresponding Source
                from a network server at no charge, through some standard or customary
                means of facilitating copying of software.  This Corresponding Source
                shall include the Corresponding Source for any work covered by version 3
                of the GNU General Public License that is incorporated pursuant to the
                following paragraph.<br><br>

                Notwithstanding any other provision of this License, you have
                permission to link or combine any covered work with a work licensed
                under version 3 of the GNU General Public License into a single
                combined work, and to convey the resulting work.  The terms of this
                License will continue to apply to the part which is the covered work,
                but the work with which it is combined will remain governed by version
                3 of the GNU General Public License.<br><br>

                14. Revised Versions of this License.<br><br>

                The Free Software Foundation may publish revised and/or new versions of
                the GNU Affero General Public License from time to time.  Such new versions
                will be similar in spirit to the present version, but may differ in detail to
                address new problems or concerns.<br><br>

                Each version is given a distinguishing version number.  If the
                Program specifies that a certain numbered version of the GNU Affero General
                Public License "or any later version" applies to it, you have the
                option of following the terms and conditions either of that numbered
                version or of any later version published by the Free Software
                Foundation.  If the Program does not specify a version number of the
                GNU Affero General Public License, you may choose any version ever published
                by the Free Software Foundation.<br><br>

                If the Program specifies that a proxy can decide which future
                versions of the GNU Affero General Public License can be used, that proxy's
                public statement of acceptance of a version permanently authorizes you
                to choose that version for the Program.<br><br>

                Later license versions may give you additional or different
                permissions.  However, no additional obligations are imposed on any
                author or copyright holder as a result of your choosing to follow a
                later version.<br><br>

                15. Disclaimer of Warranty.<br><br>

                THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY
                APPLICABLE LAW.  EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT
                HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY
                OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO,
                THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
                PURPOSE.  THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM
                IS WITH YOU.  SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF
                ALL NECESSARY SERVICING, REPAIR OR CORRECTION.<br><br>

                16. Limitation of Liability.<br><br>

                IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING
                WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MODIFIES AND/OR CONVEYS
                THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY
                GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE
                USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF
                DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD
                PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS),
                EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF
                SUCH DAMAGES.<br><br>

                17. Interpretation of Sections 15 and 16.<br><br>

                If the disclaimer of warranty and limitation of liability provided
                above cannot be given local legal effect according to their terms,
                reviewing courts shall apply local law that most closely approximates
                an absolute waiver of all civil liability in connection with the
                Program, unless a warranty or assumption of liability accompanies a
                copy of the Program in return for a fee.<br><br>

                END OF TERMS AND CONDITIONS<br>

            </p><br>
            <p class="lead">
                <?php echo LABEL_LICENSE_TEXT2; ?>
                <a href="mailto:licensing@gnu.com">licensing@gnu.com</a> <?php echo LABEL_LICENSE_TEXT3; ?><br> 
                <a href="http://www.tldrlegal.com/license/AGPL3">TLDRLegal - GNU Affero GPL v.3 explained in plain english</a><br>
                <a href="freeopensoft.php"><?php echo LABEL_LICENSE_TEXT4; ?></a>
            </p>

			<div id="freedocumentation">
				<?php 
					require("pub.php");
				?>
			</div>
			
			<hr>
            
            <div>
                <h3><?php echo LABEL_LICENSE_TEXT5; ?><br></h3>
                <br>
                <p class="lead">
                    GNU Free Documentation License
                    Version 1.3, 3 November 2008<br><br>

                    Copyright (C) 2000, 2001, 2002, 2007, 2008 Free Software Foundation, Inc.<br><br>
                    Everyone is permitted to copy and distribute verbatim copies
                    of this license document, but changing it is not allowed.<br><br>

                    0. PREAMBLE<br><br>

                    The purpose of this License is to make a manual, textbook, or other
                    functional and useful document "free" in the sense of freedom: to
                    assure everyone the effective freedom to copy and redistribute it,
                    with or without modifying it, either commercially or noncommercially.
                    Secondarily, this License preserves for the author and publisher a way
                    to get credit for their work, while not being considered responsible
                    for modifications made by others.<br><br>

                    This License is a kind of "copyleft", which means that derivative
                    works of the document must themselves be free in the same sense.  It
                    complements the GNU General Public License, which is a copyleft
                    license designed for free software.<br><br>

                    We have designed this License in order to use it for manuals for free
                    software, because free software needs free documentation: a free
                    program should come with manuals providing the same freedoms that the
                    software does.  But this License is not limited to software manuals;
                    it can be used for any textual work, regardless of subject matter or
                    whether it is published as a printed book.  We recommend this License
                    principally for works whose purpose is instruction or reference.<br><br>


                    1. APPLICABILITY AND DEFINITIONS<br><br>

                    This License applies to any manual or other work, in any medium, that
                    contains a notice placed by the copyright holder saying it can be
                    distributed under the terms of this License.  Such a notice grants a
                    world-wide, royalty-free license, unlimited in duration, to use that
                    work under the conditions stated herein.  The "Document", below,
                    refers to any such manual or work.  Any member of the public is a
                    licensee, and is addressed as "you".  You accept the license if you
                    copy, modify or distribute the work in a way requiring permission
                    under copyright law.<br><br>

                    A "Modified Version" of the Document means any work containing the
                    Document or a portion of it, either copied verbatim, or with
                    modifications and/or translated into another language.<br><br>

                    A "Secondary Section" is a named appendix or a front-matter section of
                    the Document that deals exclusively with the relationship of the
                    publishers or authors of the Document to the Document's overall
                    subject (or to related matters) and contains nothing that could fall
                    directly within that overall subject.  (Thus, if the Document is in
                    part a textbook of mathematics, a Secondary Section may not explain
                    any mathematics.)  The relationship could be a matter of historical
                    connection with the subject or with related matters, or of legal,
                    commercial, philosophical, ethical or political position regarding
                    them.<br><br>

                    The "Invariant Sections" are certain Secondary Sections whose titles
                    are designated, as being those of Invariant Sections, in the notice
                    that says that the Document is released under this License.  If a
                    section does not fit the above definition of Secondary then it is not
                    allowed to be designated as Invariant.  The Document may contain zero
                    Invariant Sections.  If the Document does not identify any Invariant
                    Sections then there are none.<br><br>

                    The "Cover Texts" are certain short passages of text that are listed,
                    as Front-Cover Texts or Back-Cover Texts, in the notice that says that
                    the Document is released under this License.  A Front-Cover Text may
                    be at most 5 words, and a Back-Cover Text may be at most 25 words.<br><br>

                    A "Transparent" copy of the Document means a machine-readable copy,
                    represented in a format whose specification is available to the
                    general public, that is suitable for revising the document
                    straightforwardly with generic text editors or (for images composed of
                    pixels) generic paint programs or (for drawings) some widely available
                    drawing editor, and that is suitable for input to text formatters or
                    for automatic translation to a variety of formats suitable for input
                    to text formatters.  A copy made in an otherwise Transparent file
                    format whose markup, or absence of markup, has been arranged to thwart
                    or discourage subsequent modification by readers is not Transparent.
                    An image format is not Transparent if used for any substantial amount
                    of text.  A copy that is not "Transparent" is called "Opaque".<br><br>

                    Examples of suitable formats for Transparent copies include plain
                    ASCII without markup, Texinfo input format, LaTeX input format, SGML
                    or XML using a publicly available DTD, and standard-conforming simple
                    HTML, PostScript or PDF designed for human modification.  Examples of
                    transparent image formats include PNG, XCF and JPG.  Opaque formats
                    include proprietary formats that can be read and edited only by
                    proprietary word processors, SGML or XML for which the DTD and/or
                    processing tools are not generally available, and the
                    machine-generated HTML, PostScript or PDF produced by some word
                    processors for output purposes only.<br><br>

                    The "Title Page" means, for a printed book, the title page itself,
                    plus such following pages as are needed to hold, legibly, the material
                    this License requires to appear in the title page.  For works in
                    formats which do not have any title page as such, "Title Page" means
                    the text near the most prominent appearance of the work's title,
                    preceding the beginning of the body of the text.<br><br>

                    The "publisher" means any person or entity that distributes copies of
                    the Document to the public.<br><br>

                    A section "Entitled XYZ" means a named subunit of the Document whose
                    title either is precisely XYZ or contains XYZ in parentheses following
                    text that translates XYZ in another language.  (Here XYZ stands for a
                    specific section name mentioned below, such as "Acknowledgements",
                    "Dedications", "Endorsements", or "History".)  To "Preserve the Title"
                    of such a section when you modify the Document means that it remains a
                    section "Entitled XYZ" according to this definition.<br><br>

                    The Document may include Warranty Disclaimers next to the notice which
                    states that this License applies to the Document.  These Warranty
                    Disclaimers are considered to be included by reference in this
                    License, but only as regards disclaiming warranties: any other
                    implication that these Warranty Disclaimers may have is void and has
                    no effect on the meaning of this License.<br><br>

                    2. VERBATIM COPYING<br><br>

                    You may copy and distribute the Document in any medium, either
                    commercially or noncommercially, provided that this License, the
                    copyright notices, and the license notice saying this License applies
                    to the Document are reproduced in all copies, and that you add no
                    other conditions whatsoever to those of this License.  You may not use
                    technical measures to obstruct or control the reading or further
                    copying of the copies you make or distribute.  However, you may accept
                    compensation in exchange for copies.  If you distribute a large enough
                    number of copies you must also follow the conditions in section 3.<br><br>

                    You may also lend copies, under the same conditions stated above, and
                    you may publicly display copies.<br><br>


                    3. COPYING IN QUANTITY<br><br>

                    If you publish printed copies (or copies in media that commonly have
                    printed covers) of the Document, numbering more than 100, and the
                    Document's license notice requires Cover Texts, you must enclose the
                    copies in covers that carry, clearly and legibly, all these Cover
                    Texts: Front-Cover Texts on the front cover, and Back-Cover Texts on
                    the back cover.  Both covers must also clearly and legibly identify
                    you as the publisher of these copies.  The front cover must present
                    the full title with all words of the title equally prominent and
                    visible.  You may add other material on the covers in addition.
                    Copying with changes limited to the covers, as long as they preserve
                    the title of the Document and satisfy these conditions, can be treated
                    as verbatim copying in other respects.<br><br>

                    If the required texts for either cover are too voluminous to fit
                    legibly, you should put the first ones listed (as many as fit
                    reasonably) on the actual cover, and continue the rest onto adjacent
                    pages.<br><br>

                    If you publish or distribute Opaque copies of the Document numbering
                    more than 100, you must either include a machine-readable Transparent
                    copy along with each Opaque copy, or state in or with each Opaque copy
                    a computer-network location from which the general network-using
                    public has access to download using public-standard network protocols
                    a complete Transparent copy of the Document, free of added material.
                    If you use the latter option, you must take reasonably prudent steps,
                    when you begin distribution of Opaque copies in quantity, to ensure
                    that this Transparent copy will remain thus accessible at the stated
                    location until at least one year after the last time you distribute an
                    Opaque copy (directly or through your agents or retailers) of that
                    edition to the public.<br><br>

                    It is requested, but not required, that you contact the authors of the
                    Document well before redistributing any large number of copies, to
                    give them a chance to provide you with an updated version of the
                    Document.<br><br>


                    4. MODIFICATIONS<br><br>

                    You may copy and distribute a Modified Version of the Document under
                    the conditions of sections 2 and 3 above, provided that you release
                    the Modified Version under precisely this License, with the Modified
                    Version filling the role of the Document, thus licensing distribution
                    and modification of the Modified Version to whoever possesses a copy
                    of it.  In addition, you must do these things in the Modified Version:<br><br>

                    A. Use in the Title Page (and on the covers, if any) a title distinct
                    from that of the Document, and from those of previous versions
                    (which should, if there were any, be listed in the History section
                    of the Document).  You may use the same title as a previous version
                    if the original publisher of that version gives permission.<br><br>
                    B. List on the Title Page, as authors, one or more persons or entities
                    responsible for authorship of the modifications in the Modified
                    Version, together with at least five of the principal authors of the
                    Document (all of its principal authors, if it has fewer than five),
                    unless they release you from this requirement.<br><br>
                    C. State on the Title page the name of the publisher of the
                    Modified Version, as the publisher.<br><br>
                    D. Preserve all the copyright notices of the Document.<br><br>
                    E. Add an appropriate copyright notice for your modifications
                    adjacent to the other copyright notices.<br><br>
                    F. Include, immediately after the copyright notices, a license notice
                    giving the public permission to use the Modified Version under the
                    terms of this License, in the form shown in the Addendum below.<br><br>
                    G. Preserve in that license notice the full lists of Invariant Sections
                    and required Cover Texts given in the Document's license notice.<br><br>
                    H. Include an unaltered copy of this License.<br><br>
                    I. Preserve the section Entitled "History", Preserve its Title, and add
                    to it an item stating at least the title, year, new authors, and
                    publisher of the Modified Version as given on the Title Page.  If
                    there is no section Entitled "History" in the Document, create one
                    stating the title, year, authors, and publisher of the Document as
                    given on its Title Page, then add an item describing the Modified
                    Version as stated in the previous sentence.<br><br>
                    J. Preserve the network location, if any, given in the Document for
                    public access to a Transparent copy of the Document, and likewise
                    the network locations given in the Document for previous versions
                    it was based on.  These may be placed in the "History" section.
                    You may omit a network location for a work that was published at
                    least four years before the Document itself, or if the original
                    publisher of the version it refers to gives permission.<br><br>
                    K. For any section Entitled "Acknowledgements" or "Dedications",
                    Preserve the Title of the section, and preserve in the section all
                    the substance and tone of each of the contributor acknowledgements
                    and/or dedications given therein.<br><br>
                    L. Preserve all the Invariant Sections of the Document,
                    unaltered in their text and in their titles.  Section numbers
                    or the equivalent are not considered part of the section titles.<br><br>
                    M. Delete any section Entitled "Endorsements".  Such a section
                    may not be included in the Modified Version.<br><br>
                    N. Do not retitle any existing section to be Entitled "Endorsements"
                    or to conflict in title with any Invariant Section.<br><br>
                    O. Preserve any Warranty Disclaimers.<br><br>

                    If the Modified Version includes new front-matter sections or
                    appendices that qualify as Secondary Sections and contain no material
                    copied from the Document, you may at your option designate some or all
                    of these sections as invariant.  To do this, add their titles to the
                    list of Invariant Sections in the Modified Version's license notice.
                    These titles must be distinct from any other section titles.<br><br>

                    You may add a section Entitled "Endorsements", provided it contains
                    nothing but endorsements of your Modified Version by various
                    parties--for example, statements of peer review or that the text has
                    been approved by an organization as the authoritative definition of a
                    standard.<br><br>

                    You may add a passage of up to five words as a Front-Cover Text, and a
                    passage of up to 25 words as a Back-Cover Text, to the end of the list
                    of Cover Texts in the Modified Version.  Only one passage of
                    Front-Cover Text and one of Back-Cover Text may be added by (or
                    through arrangements made by) any one entity.  If the Document already
                    includes a cover text for the same cover, previously added by you or
                    by arrangement made by the same entity you are acting on behalf of,
                    you may not add another; but you may replace the old one, on explicit
                    permission from the previous publisher that added the old one.<br><br>

                    The author(s) and publisher(s) of the Document do not by this License
                    give permission to use their names for publicity for or to assert or
                    imply endorsement of any Modified Version.<br><br>


                    5. COMBINING DOCUMENTS<br><br>

                    You may combine the Document with other documents released under this
                    License, under the terms defined in section 4 above for modified
                    versions, provided that you include in the combination all of the
                    Invariant Sections of all of the original documents, unmodified, and
                    list them all as Invariant Sections of your combined work in its
                    license notice, and that you preserve all their Warranty Disclaimers.<br><br>

                    The combined work need only contain one copy of this License, and
                    multiple identical Invariant Sections may be replaced with a single
                    copy.  If there are multiple Invariant Sections with the same name but
                    different contents, make the title of each such section unique by
                    adding at the end of it, in parentheses, the name of the original
                    author or publisher of that section if known, or else a unique number.
                    Make the same adjustment to the section titles in the list of
                    Invariant Sections in the license notice of the combined work.<br><br>

                    In the combination, you must combine any sections Entitled "History"
                    in the various original documents, forming one section Entitled
                    "History"; likewise combine any sections Entitled "Acknowledgements",
                    and any sections Entitled "Dedications".  You must delete all sections
                    Entitled "Endorsements".<br><br>


                    6. COLLECTIONS OF DOCUMENTS<br><br>

                    You may make a collection consisting of the Document and other
                    documents released under this License, and replace the individual
                    copies of this License in the various documents with a single copy
                    that is included in the collection, provided that you follow the rules
                    of this License for verbatim copying of each of the documents in all
                    other respects.<br><br>

                    You may extract a single document from such a collection, and
                    distribute it individually under this License, provided you insert a
                    copy of this License into the extracted document, and follow this
                    License in all other respects regarding verbatim copying of that
                    document.<br><br>


                    7. AGGREGATION WITH INDEPENDENT WORKS<br><br>

                    A compilation of the Document or its derivatives with other separate
                    and independent documents or works, in or on a volume of a storage or
                    distribution medium, is called an "aggregate" if the copyright
                    resulting from the compilation is not used to limit the legal rights
                    of the compilation's users beyond what the individual works permit.
                    When the Document is included in an aggregate, this License does not
                    apply to the other works in the aggregate which are not themselves
                    derivative works of the Document.<br><br>

                    If the Cover Text requirement of section 3 is applicable to these
                    copies of the Document, then if the Document is less than one half of
                    the entire aggregate, the Document's Cover Texts may be placed on
                    covers that bracket the Document within the aggregate, or the
                    electronic equivalent of covers if the Document is in electronic form.
                    Otherwise they must appear on printed covers that bracket the whole
                    aggregate.<br><br>


                    8. TRANSLATION<br><br>

                    Translation is considered a kind of modification, so you may
                    distribute translations of the Document under the terms of section 4.
                    Replacing Invariant Sections with translations requires special
                    permission from their copyright holders, but you may include
                    translations of some or all Invariant Sections in addition to the
                    original versions of these Invariant Sections.  You may include a
                    translation of this License, and all the license notices in the
                    Document, and any Warranty Disclaimers, provided that you also include
                    the original English version of this License and the original versions
                    of those notices and disclaimers.  In case of a disagreement between
                    the translation and the original version of this License or a notice
                    or disclaimer, the original version will prevail.<br><br>

                    If a section in the Document is Entitled "Acknowledgements",
                    "Dedications", or "History", the requirement (section 4) to Preserve
                    its Title (section 1) will typically require changing the actual
                    title.<br><br>


                    9. TERMINATION<br><br>

                    You may not copy, modify, sublicense, or distribute the Document
                    except as expressly provided under this License.  Any attempt
                    otherwise to copy, modify, sublicense, or distribute it is void, and
                    will automatically terminate your rights under this License.<br><br>

                    However, if you cease all violation of this License, then your license
                    from a particular copyright holder is reinstated (a) provisionally,
                    unless and until the copyright holder explicitly and finally
                    terminates your license, and (b) permanently, if the copyright holder
                    fails to notify you of the violation by some reasonable means prior to
                    60 days after the cessation.<br><br>

                    Moreover, your license from a particular copyright holder is
                    reinstated permanently if the copyright holder notifies you of the
                    violation by some reasonable means, this is the first time you have
                    received notice of violation of this License (for any work) from that
                    copyright holder, and you cure the violation prior to 30 days after
                    your receipt of the notice.<br><br>

                    Termination of your rights under this section does not terminate the
                    licenses of parties who have received copies or rights from you under
                    this License.  If your rights have been terminated and not permanently
                    reinstated, receipt of a copy of some or all of the same material does
                    not give you any rights to use it.<br><br>


                    10. FUTURE REVISIONS OF THIS LICENSE<br><br>

                    The Free Software Foundation may publish new, revised versions of the
                    GNU Free Documentation License from time to time.  Such new versions
                    will be similar in spirit to the present version, but may differ in
                    detail to address new problems or concerns.  See
                    http://www.gnu.org/copyleft/.<br><br>

                    Each version of the License is given a distinguishing version number.
                    If the Document specifies that a particular numbered version of this
                    License "or any later version" applies to it, you have the option of
                    following the terms and conditions either of that specified version or
                    of any later version that has been published (not as a draft) by the
                    Free Software Foundation.  If the Document does not specify a version
                    number of this License, you may choose any version ever published (not
                    as a draft) by the Free Software Foundation.  If the Document
                    specifies that a proxy can decide which future versions of this
                    License can be used, that proxy's public statement of acceptance of a
                    version permanently authorizes you to choose that version for the
                    Document.<br><br>

                    11. RELICENSING<br><br>

                    "Massive Multiauthor Collaboration Site" (or "MMC Site") means any
                    World Wide Web server that publishes copyrightable works and also
                    provides prominent facilities for anybody to edit those works.  A
                    public wiki that anybody can edit is an example of such a server.  A
                    "Massive Multiauthor Collaboration" (or "MMC") contained in the site
                    means any set of copyrightable works thus published on the MMC site.<br><br>

                    "CC-BY-SA" means the Creative Commons Attribution-Share Alike 3.0 
                    license published by Creative Commons Corporation, a not-for-profit 
                    corporation with a principal place of business in San Francisco, 
                    California, as well as future copyleft versions of that license 
                    published by that same organization.<br><br>

                    "Incorporate" means to publish or republish a Document, in whole or in 
                    part, as part of another Document.<br><br>

                    An MMC is "eligible for relicensing" if it is licensed under this 
                    License, and if all works that were first published under this License 
                    somewhere other than this MMC, and subsequently incorporated in whole or 
                    in part into the MMC, (1) had no cover texts or invariant sections, and 
                    (2) were thus incorporated prior to November 1, 2008.<br><br>

                    The operator of an MMC Site may republish an MMC contained in the site
                    under CC-BY-SA on the same site at any time before August 1, 2009,
                    provided the MMC is eligible for relicensing.
                    <br><br>
                    -----------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    <br>
                </p>
                <p class="lead">
                    <?php echo LABEL_LICENSE_TEXT6; ?>
                    <a href="mailto:licensing@gnu.com">licensing@gnu.com</a> <?php echo LABEL_LICENSE_TEXT7; ?><br> 
                    <a href="freeopensoft.php"><?php echo LABEL_LICENSE_TEXT8; ?></a>
                </p>
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
