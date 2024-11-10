<div x-data="{ expanded: false }">
    <div>
        <ul x-sort x-sort:group="todos">
            <li x-sort:item="1">foo</li>
            <li x-sort:item="2">bar</li>
            <li x-sort:item="3">baz</li>
        </ul>

        <ol x-sort x-sort:group="todos">
            <li x-sort:item="4">foo</li>
            <li x-sort:item="5">bar</li>
            <li x-sort:item="6">baz</li>
        </ol>
    </div>
</div>
