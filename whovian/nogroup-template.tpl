<h1>$header</h1>

<div class="contacts-page-wrapper">
{{ for $contacts as $contact }}
	{{ inc contact_template.tpl }}{{ endinc }}
{{ endfor }}
</div>
<div id="contact-edit-end"></div>

$paginate




