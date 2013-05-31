<h1>{{$header}}</h1>

<div class="contacts-page-wrapper">
{{foreach $contacts as $contact}}
	{{include file="contact_template.tpl"}}
{{/foreach}}
</div>
<div id="contact-edit-end"></div>

{{$paginate}}




