<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('home') }}" class="simple-text logo-normal">{{ __('Escola d\'Hostaleria') }}</a>
        </div>
        <ul class="nav">
          <li>
              <a href="{{ route('home') }}">
                  <i class="tim-icons icon-chart-pie-36"></i>
                  <p>{{ __('web.home') }}</p>
              </a>
          </li>
          <li>
              <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                  <i class="fab fa-laravel" ></i>
                  <span class="nav-link-text" >{{ __('web.user-management') }}</span>
                  <b class="caret mt-1"></b>
              </a>

              <div class="collapse show" id="laravel-examples">
                  <ul class="nav pl-4">
                      <li>
                          <a href="{{ route('profile.edit')  }}">
                              <i class="tim-icons icon-single-02"></i>
                              <p>{{ __('web.profile') }}</p>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('user.index')  }}">
                              <i class="tim-icons icon-bullet-list-67"></i>
                              <p>{{ __('web.user-management') }}</p>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
          <li>
              <a href="{{ route('apartados.products') }}">
                  <i class="tim-icons icon-planet"></i>
                  <p>{{ __('web.products') }}</p>
              </a>
          </li>
          <li>
              <a href="{{ route('apartados.ingredients') }}">
                  <i class="tim-icons icon-components"></i>
                  <p>{{ __('web.ingredients') }}</p>
              </a>
          </li>
          <li>
              <a href="{{ route('apartados.categories') }}">
                  <i class="tim-icons icon-planet"></i>
                  <p>{{ __('web.categories') }}</p>
              </a>
          </li>
          <li>
              <a href="{{ route('apartados.messages') }}">
                  <i class="tim-icons icon-email-85"></i>
                  <p>{{ __('web.messages') }}</p>
              </a>
          </li>

          <li>
              <a href="{{ route('apartados.orders') }}">
                  <i class="tim-icons icon-bag-16"></i>
                  <p>{{ __('web.orders') }}</p>
              </a>
          </li>

          <li>
              <a href="{{ route('apartados.alergens') }}">
                  <i class="tim-icons icon-sound-wave"></i>
                  <p>{{ __('web.allergens') }}</p>
              </a>
          </li>

          <li>
              <a href="{{ route('apartados.noticias') }}">
                  <i class="tim-icons icon-pin"></i>
                  <p>{{ __('web.articles') }}</p>
              </a>
          </li>
        </ul>
    </div>
</div>
