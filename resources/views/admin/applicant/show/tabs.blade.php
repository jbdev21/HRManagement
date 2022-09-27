<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ route('applicant.show', $applicant->id) }}?tab=document" class="nav-link {{ Request::get('tab') == 'document' ? 'active' : '' }}" id="document-tab"  type="button" role="tab" aria-controls="profile" aria-selected="false">Document</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('applicant.show', $applicant->id) }}?tab=work-experience" class="nav-link {{ Request::get('tab') == 'work-experience' ? 'active' : '' }}" id="experience-tab"  type="button" role="tab" aria-controls="contact" aria-selected="false">Work Experience</a>
    </li>
</ul>