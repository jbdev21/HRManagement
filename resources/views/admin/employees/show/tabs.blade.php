<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{ route('employees.show', $employee->id) }}" class="nav-link {{ Request::get('tab') == '' ? 'active' : '' }}" id="profile-tab" type="button" role="tab" aria-controls="home" aria-selected="true">Personal</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('employees.show', $employee->id) }}?tab=leave" class="nav-link {{ Request::get('tab') == 'leave' ? 'active' : '' }}" id="leave-tab"  type="button" role="tab" aria-controls="profile" aria-selected="false">Leaves</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('employees.show', $employee->id) }}?tab=document" class="nav-link {{ Request::get('tab') == 'document' ? 'active' : '' }}" id="document-tab"  type="button" role="tab" aria-controls="profile" aria-selected="false">Document</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="{{ route('employees.show', $employee->id) }}?tab=work-experience" class="nav-link {{ Request::get('tab') == 'work-experience' ? 'active' : '' }}" id="experience-tab"  type="button" role="tab" aria-controls="contact" aria-selected="false">Work Experience</a>
    </li>
</ul>