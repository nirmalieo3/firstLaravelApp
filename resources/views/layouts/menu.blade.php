<li class="nav-item">
    <a href="{{ route('teachers.index') }}"
       class="nav-link {{ Request::is('teachers*') ? 'active' : '' }}">
        <p>Teachers</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('courses.index') }}"
       class="nav-link {{ Request::is('courses*') ? 'active' : '' }}">
        <p>Courses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('students.index') }}"
       class="nav-link {{ Request::is('students*') ? 'active' : '' }}">
        <p>Students</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('times.index') }}"
       class="nav-link {{ Request::is('times*') ? 'active' : '' }}">
        <p>Times</p>
    </a>
</li>





