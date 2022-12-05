<nav class="sidebar sidebar-offcanvas position-fixed" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('cms.dashboard') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Meni</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#posiljke-meni" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon mdi mdi-inbox"></i>
          <span class="menu-title">Pošiljke</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="posiljke-meni">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.posiljka.create') }}">Nova</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.posiljka.create') }}?prethodna">Nova (prethodna)</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.posiljka.index') }}">Lista</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.posiljke-stornirane') }}">Lista (stornirane)</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#dostava-meni" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-truck-delivery menu-icon"></i>
          <span class="menu-title">Dostava pošiljaka</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="dostava-meni">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.dostava.create') }}">Nova</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.dostava.index') }}">Lista</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#kompanija-meni" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-city menu-icon"></i>
          <span class="menu-title">Firme</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="kompanija-meni">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.kompanija.create') }}">Nova</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.kompanija.index') }}">Lista</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ugovor-meni" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-note-text menu-icon"></i>
          <span class="menu-title">Ugovori</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="ugovor-meni">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.ugovor.create') }}">Novi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.ugovor.index') }}">Lista</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#radnici-meni" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-worker menu-icon"></i>
          <span class="menu-title">Radnici</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="radnici-meni">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.radnik.create') }}">Novi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('cms.radnik.index') }}">Lista</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">Administracija</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mdi mdi-file-document menu-icon"></i>
          <span class="menu-title">Izveštaji</span>
        </a>
      </li>
      {{-- <li class="nav-item nav-category">Forms and Datas</li>
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="menu-icon mdi mdi-card-text-outline"></i>
          <span class="menu-title">Form elements</span>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="menu-icon mdi mdi-chart-line"></i>
          <span class="menu-title">Charts</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="menu-icon mdi mdi-table"></i>
          <span class="menu-title">Tables</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="menu-icon mdi mdi-layers-outline"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">pages</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">help</li>
      <li class="nav-item">
        <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
          <i class="menu-icon mdi mdi-file-document"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li> --}}
    </ul>
  </nav>