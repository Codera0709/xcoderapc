# Table Component

The table component is a reusable data display element with support for headers, rows, and footer.

## Usage

```blade
<x-data.table
    :headers="[
        ['label' => 'Name', 'sortable' => true],
        ['label' => 'Email', 'sortable' => true],
        ['label' => 'Status', 'sortable' => false],
    ]"
    :rows="[
        ['John Doe', 'john@example.com', 'Active'],
        ['Jane Smith', 'jane@example.com', 'Inactive'],
    ]"
    :striped="true"
    :hover="true"
>
    <x-slot name="footer">
        <div class="flex justify-between items-center">
            <p>Showing 1 to 2 of 2 entries</p>
            <div class="flex space-x-2">
                <x-ui.button size="sm" variant="outline">Previous</x-ui.button>
                <x-ui.button size="sm" variant="outline">Next</x-ui.button>
            </div>
        </div>
    </x-slot>
</x-data.table>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `headers` | array | [] | Array of header definitions with 'label' and 'sortable' keys |
| `rows` | array | [] | Array of row data |
| `striped` | boolean | true | Whether to apply striped row styling |
| `hover` | boolean | true | Whether to apply hover state styling |
| `bordered` | boolean | false | Whether to add borders to the table |
| `stickyHeader` | boolean | false | Whether to make the header sticky |
| `sortable` | boolean | false | Whether to indicate headers as sortable |
| `compact` | boolean | false | Whether to use compact spacing |

## Slots

- `default`: Main content of the table (typically the tbody)
- `footer`: Optional footer for the table (typically for pagination)

## Notes

- The component supports empty state display when no rows are provided
- It's fully responsive and includes dark mode support
- Sorting indicators are only visual; actual sorting must be handled by parent component