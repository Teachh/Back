<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('BD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Black Dashboard') }}</a>
        </div>
        <ul class="nav">
          <li>
              <a href="{{ route('home') }}">
                  <i class="tim-icons icon-chart-pie-36"></i>
                  <p>{{ __('Inicio') }}</p>
              </a>
          </li>
          <li>
              <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                  <i class="fab fa-laravel" ></i>
                  <span class="nav-link-text" >{{ __('Control Usuarios') }}</span>
                  <b class="caret mt-1"></b>
              </a>

              <div class="collapse show" id="laravel-examples">
                  <ul class="nav pl-4">
                      <li>
                          <a href="{{ route('profile.edit')  }}">
                              <i class="tim-icons icon-single-02"></i>
                              <p>{{ __('User Profile') }}</p>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('user.index')  }}">
                              <i class="tim-icons icon-bullet-list-67"></i>
                              <p>{{ __('User Management') }}</p>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          <li>
              <a href="{{ route('apartados.products') }}">
                  <i class="tim-icons icon-planet"></i>
                  <p>{{ __('Productos') }}</p>
              </a>
          </li>
          <li>
              <a href="{{ route('apartados.ingredients') }}">
                  <i class="tim-icons icon-components"></i>
                  <p>{{ __('Ingredientes') }}</p>
              </a>
          </li>
          <li>
              <a href="{{ route('apartados.messages') }}">
                  <i class="tim-icons icon-email-85"></i>
                  <p>{{ __('Mensajes') }}</p>
              </a>
          </li>

          <!--- A PARTIR DE LO DE ARRIVA --->
            <li>
                <a href="{{ route('pages.icons') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('pages.maps') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('pages.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('pages.typography') }}">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li>
            <li class=" {{ $pageSlug ?? '' == 'upgrade' ? 'active' : '' }}">
                <a href="{{ route('pages.upgrade') }}">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>{{ __('Upgrade to PRO') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
