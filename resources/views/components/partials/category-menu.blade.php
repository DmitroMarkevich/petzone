<div class="category-wrapper"
     x-data="{ open: false, timeout: null }"
     @mouseenter="clearTimeout(timeout); open = true"
     @mouseleave="timeout = setTimeout(() => open = false, 300)"
>
    <button class="category-btn" type="button" aria-label="Категорії">
        <img src="{{ asset('images/header/category.svg') }}" alt="Категорії">Категорії
    </button>

    <div class="category-menu" x-show="open" x-transition x-cloak>
        <ul class="category-list">
            @foreach ($headerCategories as $parent)
                <li class="category-item" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('advert.index', ['category' => $parent->slug]) }}"
                       class="parent {{ $parent->children->count() ? 'has-children' : '' }}">
                        {{ $parent->name }}
                    </a>
                    <div class="mega-menu" x-show="open" x-cloak>
                        <div class="mega-menu-with-children">
                            @foreach ($parent->children->filter(fn($child) => $child->children->isNotEmpty()) as $child)
                                <div class="mega-menu-col">
                                    <a href="{{ route('advert.index', ['category' => $child->slug]) }}" class="subcategory-link">
                                        {{ $child->name }}
                                    </a>
                                    <ul class="mega-sublist">
                                        @foreach ($child->children as $subchild)
                                            <li>
                                                <a href="{{ route('advert.index', ['category' => $subchild->slug]) }}" class="mega-link">
                                                    {{ $subchild->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>

                        <div class="mega-menu-no-children">
                            @foreach ($parent->children->filter(fn($child) => $child->children->isEmpty()) as $child)
                                <div class="mega-menu-col no-children">
                                    <a href="{{ route('advert.index', ['category' => $child->slug]) }}" class="subcategory-link">
                                        {{ $child->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

