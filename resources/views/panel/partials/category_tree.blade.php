<ul style="list-style-type: none; padding-left: 0;">
    @foreach ($categories as $category)
        <li>
            <label>
                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                       {{ in_array($category->id, $selected) ? 'checked' : '' }}>
                {{ $category->name }}
            </label>

            @if ($category->child_categories && $category->child_categories->count())
                @include('panel.partials.category_tree', [
                    'categories' => $category->child_categories,
                    'selected' => $selected
                ])
            @endif
        </li>
    @endforeach
</ul>