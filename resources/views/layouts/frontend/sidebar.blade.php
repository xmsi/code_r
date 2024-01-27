        <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
        <aside id="colorlib-aside" role="complementary" class="border js-fullheight">
            <h1 id="colorlib-logo" style="padding: 20px;"><a href="/">The heart team of Uzbekistan</a></h1>
            <nav id="colorlib-main-menu" role="navigation">
                <ul>
                    <li class="{{ request()->is('/') ? 'colorlib-active' : '' }} firstli"><a href="/">{{ __('Главная') }}</a></li>
                    <li class="sidebar-dropdown firstli">
                        <a href="#" onclick="return false;" style="margin-bottom: 5px;">
                          <span>{{ __('Для пациентов') }}</span>
                      </a>
                      <img src="/assets/images/next.png" class="iconnext" alt="">
                      <div class="sidebar-submenu">
                          <ul>
                            <li style="margin-top: 10px"><a href="/symptoms">{{ __('Симптомы') }}</a></li>
                            <li><a href="/illnesses">{{ __('Заболевания') }}</a></li>
                            <li><a href="/diagnostika">{{ __('Диагностика') }}</a></li>
                            <li><a href="/treatment">{{ __('Методы Лечения') }}</a></li>
                          </ul>
                      </div>
                  </li>
                    <li class="sidebar-dropdown firstli">
                        <a href="#" onclick="return false;" style="margin-bottom: 5px;">
                          <span>{{ __('Для специалистов') }}</span>
                      </a>
                      <img src="/assets/images/next.png" class="iconnext" alt="">
                      <div class="sidebar-submenu">
                          <ul>
                            <li class="sidebar-dropdown2">
                              <a href="#" onclick="return false;"><span>{{ __('Библиотека') }}</span></a>
                              <img src="/assets/images/next.png" class="iconnext2" alt="">
                              <div class="sidebar-submenu2">
                                <ul>
                                  <li class="{{ request()->is('bookspage') ? 'colorlib-active' : '' }}"><a href="/bookspage">{{ __('Книги') }}</a></li>
                                  <li class="{{ request()->is('recomendpage') ? 'colorlib-active' : '' }}"><a href="/recomendpage">{{ __('Рекомендации') }}</a></li>
                                  <li><a href="#">{{ __('Международные журналы') }}</a></li>
                                </ul>
                              </div>
                            </li>
                            <li class="sidebar-dropdown2">
                              <a href="#" onclick="return false;"><span>{{ __('Видеоблог') }}</span></a>
                              <img src="/assets/images/next.png" class="iconnext2" alt="">
                              <div class="sidebar-submenu2">
                                <ul>
                                  <li class="{{ request()->is('videoblog*') ? 'colorlib-active' : '' }}"><a href="/videoblog/ru">Пятиминутка (русс)</a></li>
                                  <li class="{{ request()->is('videoblog*') ? 'colorlib-active' : '' }}"><a href="/videoblog/uz">5minutka (uz)</a></li>
                                </ul>
                              </div>
                            </li>
                            <li><a class="{{ request()->is('internationalc*') ? 'colorlib-active' : '' }}" href="/internationalc">{{ __('Международные конференции') }}</a></li>
                          </ul>
                      </div>
                  </li>
                    <li class="sidebar-dropdown firstli">
                        <a href="#" onclick="return false;" style="margin-bottom: 5px;">
                          <span>{{ __('Команда') }}</span>
                      </a>
                      <img src="/assets/images/next.png" class="iconnext" alt="">
                      <div class="sidebar-submenu">
                          <ul>
                            <li class="{{ request()->is('history*') ? 'colorlib-active' : '' }}"><a href="/history">{{ __('История создания команды') }}</a></li>
                            <li class="{{ request()->is('doctors*') ? 'colorlib-active' : '' }}"><a href="/doctors">{{ __('Члены команды') }}</a></li>
                            <li><a href="#">{{ __('Как попасть в команду?') }}</a></li>
                          </ul>
                      </div>
                  </li>
                    <li class="sidebar-dropdown secondli">
                        <a href="#" onclick="return false;" style="margin-bottom: 5px;">
                          <span>{{ __('Деятельность') }}</span>
                      </a>
                      <img src="/assets/images/next.png" class="iconnext" alt="">
                      <div class="sidebar-submenu">
                          <ul>
                            <li class="{{ request()->is('workshops*') ? 'colorlib-active' : '' }}"><a href="/workshops">{{ __('Воркшопы') }}</a></li>
                            <li class="{{ request()->is('developments*') ? 'colorlib-active' : '' }}"><a href="/developments">{{ __('Разработки') }}</a></li>
                            <li class="{{ request()->is('smi*') ? 'colorlib-active' : '' }}"><a href="/smi">{{ __('Сми о нас') }}</a></li>
                          </ul>
                      </div>
                  </li>  
                </ul>
            </nav>

<!--             <div class="colorlib-footer">
                <ul>
                    <li><a href="#"><i class="icon-facebook2"></i></a></li>
                    <li><a href="#"><i class="icon-twitter2"></i></a></li>
                    <li><a href="#"><i class="icon-instagram"></i></a></li>
                    <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                </ul>
            </div> -->

        </aside>