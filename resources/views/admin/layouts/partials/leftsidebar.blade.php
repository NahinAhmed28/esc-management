<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{ ($sitesetting->logo) ?  asset('storage/'.$sitesetting->logo) : asset('site/assets/images/logo.png') }}" alt="{{( $sitesetting->{'title_'. app()->getLocale()} )? $sitesetting->{'title_'. app()->getLocale()} :__('admin.menu.site_short') }}" class="brand-image img-circle elevation-3" style="opacity:1;width: 90%; margin-left: 0rem;">
      {{-- <span class="brand-text font-weight-light" style="font-weight: bold!important;">{{( $sitesetting->{'title_'. app()->getLocale()} )? $sitesetting->{'title_'. app()->getLocale()} :__('admin.menu.site_short') }}</span>  --}}
    </a>

    

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.dashboard') ? 'active' : '' ;}}">
              <i style="margin-left: -6px" class="nav-icon fas fa-th"></i>
              <p>
                {{__('admin.menu.dashboard')}}
              </p>
            </a>
          </li>
        
          <li class="nav-item has-child {{$retVal = (request()->route()->getPrefix() == 'admin/role-permissions') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="fab fa-critical-role"></i>
              <p>
                {{__('admin.menu.role_parent')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              @can('parent', app('App\Models\SiteSetting'))
              <li class="nav-item">
                <a href="{{route('admin.site_setting')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.site_setting') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.site_setting')}} </p>
                </a>
              </li>
              @endcan
              
              
              @can('parent', app('App\Models\Role'))
              <li class="nav-item">
                <a href="{{route('admin.role')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.role') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.role')}} </p>
                </a>
              </li>
              @endcan
              
              @can('parent', app('App\Models\UserType'))
              <li class="nav-item">
                <a href="{{route('admin.user_type')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.user_type') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.user_type')}} </p>
                </a>
              </li>
              @endcan

              {{-- @can('parent', app('App\Models\Lang'))
              <li class="nav-item">
                <a href="{{route('admin.lang')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.lang') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.lang')}} </p>
                </a>
              </li>
              @endcan --}}

            </ul>
          </li>


          <li class="nav-item has-child {{$retVal = (request()->route()->getPrefix() == 'admin/master') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="fa fa-database" aria-hidden="true"></i>
              <p>
                {{__('admin.menu.master')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              {{-- @can('parent', app('App\Models\Condition'))
              <li class="nav-item">
                <a href="{{route('admin.condition')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.condition') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.condition')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Color'))
              <li class="nav-item">
                <a href="{{route('admin.color')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.color') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.color')}} </p>
                </a>
              </li>
              @endcan --}}

              @can('parent', app('App\Models\OfficeType'))
              <li class="nav-item">
                <a href="{{route('admin.office_type')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.office_type') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.office_type')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\ServiceType'))
              <li class="nav-item">
                <a href="{{route('admin.service_type')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.service_type') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.service_type')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Service'))
              <li class="nav-item">
                <a href="{{route('admin.service')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.service') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.service')}} </p>
                </a>
              </li>
              @endcan


              @can('parent', app('App\Models\Approval'))
              <li class="nav-item">
                <a href="{{route('admin.approval')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.approval') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.approval')}} </p>
                </a>
              </li>
              @endcan

            </ul>

          </li>


          <li class="nav-item has-child {{$retVal = (request()->route()->getPrefix() == 'admin/administrative-locations') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <p>
                {{__('admin.menu.administrative_location_parent')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @can('parent', app('App\Models\Division'))
              <li class="nav-item">
                <a href="{{route('admin.division')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.division') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.division')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\District'))
              <li class="nav-item">
                <a href="{{route('admin.district')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.district') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.district')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Upazila'))
              <li class="nav-item">
                <a href="{{route('admin.upazila')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.upazila') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.upazila')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Thana'))
              <li class="nav-item">
                <a href="{{route('admin.thana')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.thana') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.thana')}} </p>
                </a>
              </li>
              @endcan
            </ul>
          </li>

          <li class="nav-item has-child {{$retVal = (request()->route()->getPrefix() == 'admin/locations') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <p>
                {{__('admin.menu.location_parent')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @can('parent', app('App\Models\Association'))
              <li class="nav-item">
                <a href="{{route('admin.association')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.association') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.association')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Area'))
              <li class="nav-item">
                <a href="{{route('admin.area')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.area') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.area')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Branch'))
              <li class="nav-item">
                <a href="{{route('admin.branch')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.branch') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.branch')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\BranchUnit'))
              <li class="nav-item">
                <a href="{{route('admin.branch_unit')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.branch_unit') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.branch_unit')}} </p>
                </a>
              </li>
              @endcan

            </ul>
          </li>
        
          <li class="nav-item has-child {{$retVal = (request()->route()->getPrefix() == 'admin/users') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i style="margin-left: -4px" class="fa fa-users" aria-hidden="true"></i>
              {{-- <i class="fa fa-building" aria-hidden="true"></i> --}}
              <p>
                {{__('admin.menu.user_parent')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              @can('parent', app('App\Models\Admin'))
              <li class="nav-item">
                <a href="{{route('admin.admin')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.admin') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.admin')}} </p>
                </a>
              </li>
              @endcan
              
              @can('parent', app('App\Models\BranchUser'))
              <li class="nav-item">
                <a href="{{route('admin.branch_user')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.branch_user') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.branch_user')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\User'))
              <li class="nav-item">
                <a href="{{route('admin.user')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.user') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.user')}} </p>
                </a>
              </li>
              @endcan

              
            </ul>
          </li>


          <li class="nav-item has-child {{$retVal = (request()->route()->getPrefix() == 'admin/applications') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i style="margin-left: -4px" class="fa fa-credit-card" aria-hidden="true"></i>
              <p>
                {{__('admin.menu.applications')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('parent', app('App\Models\Application'))
              <li class="nav-item">
                <a href="{{route('admin.application')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.application') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.application')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Applicationdeclined'))
              <li class="nav-item">
                <a href="{{route('admin.applicationdeclined')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.applicationdeclined') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.applicationdeclined')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Applicationreview'))
              <li class="nav-item">
                <a href="{{route('admin.applicationreview')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.applicationreview') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.applicationreview')}} </p>
                </a>
              </li>
              @endcan

              @can('parent', app('App\Models\Applicationcomplete'))
              <li class="nav-item">
                <a href="{{route('admin.applicationcomplete')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.applicationcomplete') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.applicationcomplete')}} </p>
                </a>
              </li>
              @endcan
            </ul>

          </li>

          {{-- <li class="nav-item has-child {{$retVal = (request()->route()->getPrefix() == 'admin/payment') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="fa fa-credit-card" aria-hidden="true"></i>
              <p>
                {{__('admin.menu.payment_parent')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('parent', app('App\Models\Transaction'))
              <li class="nav-item">
                <a href="{{route('admin.transaction')}}" class="menu-loader nav-link {{$retVal = (Route::current()->getName() == 'admin.transaction') ? 'active' : '' ;}}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>{{__('admin.menu.transaction')}} </p>
                </a>
              </li>
              @endcan
            </ul>

          </li> --}}



          @php
            // @$prefix = preg_split ("/\//", request()->route()->getPrefix()); 
            // @$getPrefix = $prefix[0].'/'.$prefix[1];
          @endphp
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>