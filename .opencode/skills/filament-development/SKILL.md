---
name: filament-development
description: "Use for any task or question involving FilamentPHP. Activate if user mentions Filament resources, forms, infolists, tables, actions, widgets, panels, or admin panel development. Covers building admin panels, CRUD resources, form builders, table listings, custom pages, and dashboard widgets. Use for all Filament v5 specific tasks including creating resources, form fields, table columns, filters, actions, and customization. Do not use for plain Laravel without Filament, or other admin panel frameworks."
license: MIT
metadata:
  author: laravel
---

# FilamentPHP v5 Development

## Documentation

Use `search-docs` for detailed Filament v5 patterns and documentation.

## Basic Concepts

### What is Filament?

Filament is a Laravel UI framework built on Livewire, Alpine.js, and Tailwind CSS. UIs are defined in PHP via fluent, chainable components. It provides:

- **Resources**: Complete CRUD interfaces for Eloquent models
- **Forms**: Powerful form builders with validation
- **Tables**: Data tables with sorting, filtering, searching
- **Infolists**: Read-only data displays
- **Actions**: Buttons with optional modal forms
- **Widgets**: Dashboard components
- **Panels**: Multi-panel admin applications

### Directory Structure

```
app/Filament/
├── Resources/              # CRUD resources
│   └── UserResource.php
├── Pages/                  # Custom pages
│   └── Dashboard.php
├── Widgets/                # Dashboard widgets
│   └── StatsOverview.php
└── Clusters/               # Resource clusters
```

## Artisan Commands

### Creating Resources

```bash
# Create a resource with form, table, and pages
php artisan make:filament-resource User

# With specific options
php artisan make:filament-resource User --generate          # Auto-generate form/table from model
php artisan make:filament-resource User --simple            # Simple resource (no List/Create/Edit)
php artisan make:filament-resource User --view              # Include View page
php artisan make:filament-resource User --soft-deletes      # Include soft delete actions
php artisan make:filament-resource User --cluster=Settings  # Place in cluster
```

### Creating Components

```bash
# Pages
php artisan make:filament-page Settings

# Custom form page
php artisan make:filament-page ManageSettings --resource=SettingResource --type=ManageRelatedRecords

# Widgets
php artisan make:filament-widget StatsOverview --stats-overview
php artisan make:filament-widget RevenueChart --chart
php artisan make:filament-widget LatestOrders --table

# Relation managers
php artisan make:filament-relation-manager UserResource posts title

# Other
php artisan make:filament-cluster Settings
```

## Resources

### Basic Resource Structure

```php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'User Management';
    
    protected static ?int $navigationSort = 1;
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form components here
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Table columns here
            ])
            ->filters([
                // Filters here
            ])
            ->actions([
                // Row actions here
            ])
            ->bulkActions([
                // Bulk actions here
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // Relation managers here
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
```

## Forms

### Form Components

All form components are in `Filament\Forms\Components\` namespace.

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

// Basic text input
TextInput::make('name')
    ->required()
    ->maxLength(255)
    ->placeholder('Enter name')
    ->helperText('The user\'s full name')
    ->prefix('Mr./Ms.')
    ->suffix('Required');

// Email with validation
TextInput::make('email')
    ->email()
    ->required()
    ->unique(ignoreRecord: true);

// Select with options
Select::make('status')
    ->options([
        'draft' => 'Draft',
        'published' => 'Published',
        'archived' => 'Archived',
    ])
    ->required()
    ->native(false); // Use custom dropdown

// Select from enum
Select::make('role')
    ->options(UserRole::class)
    ->required();

// Relationship select (BelongsTo)
Select::make('author_id')
    ->relationship('author', 'name')
    ->searchable()
    ->preload()
    ->required();

// Conditional visibility
Select::make('type')
    ->options(CompanyType::class)
    ->required()
    ->live(),

TextInput::make('company_name')
    ->required()
    ->visible(fn (Get $get): bool => $get('type') === 'business'),

// Reactive field with afterStateUpdated
TextInput::make('title')
    ->required()
    ->live(onBlur: true)
    ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
        'slug',
        Str::slug($state ?? ''),
    )),

TextInput::make('slug')
    ->required(),

// File upload
FileUpload::make('avatar')
    ->image()
    ->imageEditor()
    ->directory('avatars')
    ->visibility('public')
    ->maxSize(5120), // 5MB

// Repeater for HasMany relationships
Repeater::make('qualifications')
    ->relationship()
    ->schema([
        TextInput::make('institution')
            ->required(),
        TextInput::make('qualification')
            ->required(),
        DatePicker::make('completed_at'),
    ])
    ->columns(2)
    ->collapsible()
    ->itemLabel(fn (array $state): ?string => $state['institution'] ?? null),

// Date/time pickers
DatePicker::make('birth_date')
    ->native(false)
    ->displayFormat('M d, Y'),

DateTimePicker::make('published_at')
    ->native(false)
    ->timezone('America/New_York'),
```

### Layout Components

```php
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs;

// Section with grid
Section::make('User Details')
    ->description('Enter the user\'s basic information')
    ->schema([
        Grid::make(2)
            ->schema([
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
            ]),
        TextInput::make('email')
            ->email()
            ->required()
            ->columnSpanFull(),
    ])
    ->collapsible()
    ->persistCollapsed(),

// Tabs
Tabs::make('Content')
    ->tabs([
        Tabs\Tab::make('English')
            ->schema([
                TextInput::make('title_en')->required(),
                RichEditor::make('content_en'),
            ]),
        Tabs\Tab::make('Spanish')
            ->schema([
                TextInput::make('title_es'),
                RichEditor::make('content_es'),
            ]),
    ]),

// Fieldset (group related fields)
Fieldset::make('Address')
    ->schema([
        TextInput::make('street'),
        TextInput::make('city'),
        TextInput::make('postal_code'),
    ]),
```

## Tables

### Table Columns

All table columns are in `Filament\Tables\Columns\` namespace.

```php
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

// Basic text column
TextColumn::make('name')
    ->searchable()
    ->sortable()
    ->limit(50)
    ->tooltip(fn ($record): string => $record->name);

// Computed column
TextColumn::make('full_name')
    ->state(fn (User $record): string => "{$record->first_name} {$record->last_name}"),

// Badge column for enums/statuses
TextColumn::make('status')
    ->badge()
    ->color(fn (string $state): string => match ($state) {
        'draft' => 'gray',
        'published' => 'success',
        'archived' => 'warning',
        default => 'gray',
    })
    ->icon(fn (string $state): string => match ($state) {
        'draft' => 'heroicon-o-pencil',
        'published' => 'heroicon-o-check-circle',
        'archived' => 'heroicon-o-archive-box',
        default => 'heroicon-o-question-mark-circle',
    }),

// Icon column
IconColumn::make('is_active')
    ->boolean()
    ->trueIcon('heroicon-o-check-circle')
    ->falseIcon('heroicon-o-x-circle')
    ->trueColor('success')
    ->falseColor('danger');

// Image column
ImageColumn::make('avatar')
    ->circular()
    ->defaultImageUrl(fn ($record): string => "https://ui-avatars.com/api/?name={$record->name}");

// Toggle for boolean (inline edit)
ToggleColumn::make('is_featured'),

// Relationship column
TextColumn::make('author.name')
    ->searchable()
    ->sortable(),

// Date column
TextColumn::make('created_at')
    ->dateTime('M d, Y')
    ->sortable()
    ->toggleable(isToggledHiddenByDefault: true),
```

### Table Filters

```php
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

// Select filter for enum/status
SelectFilter::make('status')
    ->options([
        'draft' => 'Draft',
        'published' => 'Published',
    ])
    ->native(false),

// Select filter for enum class
SelectFilter::make('role')
    ->options(UserRole::class),

// Relationship filter
SelectFilter::make('author')
    ->relationship('author', 'name')
    ->searchable()
    ->preload(),

// Ternary filter (yes/no/all)
TernaryFilter::make('is_active'),

// Custom filter with query
Filter::make('created_at')
    ->form([
        DatePicker::make('created_from'),
        DatePicker::make('created_until'),
    ])
    ->query(function (Builder $query, array $data): Builder {
        return $query
            ->when(
                $data['created_from'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            )
            ->when(
                $data['created_until'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
            );
    }),
```

### Table Actions

```php
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;

// Standard actions
->actions([
    ViewAction::make(),
    EditAction::make(),
    DeleteAction::make(),
])

// Custom action with modal
->actions([
    Action::make('promote')
        ->icon('heroicon-o-arrow-up-circle')
        ->color('success')
        ->requiresConfirmation()
        ->modalHeading('Promote User')
        ->modalDescription('Are you sure you want to promote this user?')
        ->modalSubmitActionLabel('Yes, Promote')
        ->action(fn (User $record) => $record->promote()),
    
    // Action with form
    Action::make('updateRole')
        ->form([
            Select::make('role')
                ->options(UserRole::class)
                ->required(),
        ])
        ->action(fn (array $data, User $record) => $record->update($data)),
    
    // Action group
    ActionGroup::make([
        ViewAction::make(),
        EditAction::make(),
        DeleteAction::make(),
    ])->label('Actions'),
])

// Bulk actions
->bulkActions([
    BulkActionGroup::make([
        DeleteBulkAction::make(),
        BulkAction::make('export')
            ->icon('heroicon-o-arrow-down-tray')
            ->action(fn (Collection $records) => /* export logic */),
    ]),
])
```

## Infolists

Infolists display read-only data:

```php
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;

public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Section::make('User Information')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('email'),
                    TextEntry::make('created_at')
                        ->dateTime('M d, Y H:i'),
                ])
                ->columns(2),
            
            Section::make('Profile')
                ->schema([
                    ImageEntry::make('avatar')
                        ->circular(),
                    TextEntry::make('bio')
                        ->markdown()
                        ->columnSpanFull(),
                ]),
        ]);
}
```

## Actions

Actions are reusable button components with optional modal forms.

```php
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

// Page header action
protected function getHeaderActions(): array
{
    return [
        Action::make('settings')
            ->icon('heroicon-o-cog-6-tooth')
            ->url(route('filament.admin.pages.settings')),
        
        Action::make('notify')
            ->requiresConfirmation()
            ->action(fn () => $this->notifyUsers()),
        
        // Action with form
        Action::make('invite')
            ->form([
                TextInput::make('email')
                    ->email()
                    ->required(),
                Select::make('role')
                    ->options(UserRole::class)
                    ->required(),
            ])
            ->action(fn (array $data) => User::invite($data)),
    ];
}
```

## Widgets

### Stats Overview

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('32% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('New Orders', Order::where('created_at', '>=', now()->subDay())->count())
                ->description('7 new orders today')
                ->color('info'),
            
            Stat::make('Revenue', '$' . number_format(Order::sum('total') / 100, 2))
                ->description('This month')
                ->color('warning'),
        ];
    }
}
```

### Chart Widget

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Orders';
    
    protected function getData(): array
    {
        $data = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');
        
        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data->values(),
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $data->keys(),
        ];
    }
    
    protected function getType(): string
    {
        return 'line';
    }
}
```

### Table Widget

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('customer.name'),
                Tables\Columns\TextColumn::make('total')
                    ->money('usd'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->since(),
            ]);
    }
}
```

## Custom Pages

```php
<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Reports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static string $view = 'filament.pages.reports';
    
    protected function getHeaderActions(): array
    {
        return [
            // Actions here
        ];
    }
}
```

Blade view (`resources/views/filament/pages/reports.blade.php`):
```blade
<x-filament-panels::page>
    <div>
        {{-- Custom content here --}}
    </div>
</x-filament-panels::page>
```

## Relation Managers

```php
<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('content'),
            ]);
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
```

## Best Practices

### Correct Namespaces

- **Form fields** (`TextInput`, `Select`, `Repeater`, etc.): `Filament\Forms\Components\`
- **Infolist entries** (`TextEntry`, `IconEntry`, etc.): `Filament\Infolists\Components\`
- **Layout components** (`Grid`, `Section`, `Fieldset`, `Tabs`, `Wizard`, etc.): `Filament\Schemas\Components\`
- **Schema utilities** (`Get`, `Set`, etc.): `Filament\Schemas\Components\Utilities\`
- **Table columns** (`TextColumn`, `IconColumn`, etc.): `Filament\Tables\Columns\`
- **Table filters** (`SelectFilter`, `Filter`, etc.): `Filament\Tables\Filters\`
- **Actions** (`DeleteAction`, `CreateAction`, etc.): `Filament\Actions\`. Never use `Filament\Tables\Actions\`, `Filament\Forms\Actions\`, or any other sub-namespace for actions.
- **Icons**: `Filament\Support\Icons\Heroicon` enum (e.g., `Heroicon::PencilSquare`)

### Static make() Methods

Always use static `make()` methods to initialize components:

```php
TextInput::make('name') // Correct
// NOT new TextInput('name')
```

Most configuration methods accept a `Closure` for dynamic values.

### Property Types

Use correct property types when overriding `Page`, `Resource`, and `Widget` properties:

```php
// Correct
protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-users';
protected static string | UnitEnum | null $navigationGroup = 'User Management';

// On Page and Widget classes (not static!)
protected string $view = 'filament.pages.custom';
```

### File Uploads

Never assume public file visibility. File visibility is `private` by default. Always use `->visibility('public')` when public access is needed:

```php
FileUpload::make('avatar')
    ->image()
    ->visibility('public') // Important!
    ->directory('avatars'),
```

### Layout Defaults

Never assume full-width layout. `Grid`, `Section`, `Fieldset`, and `Repeater` do not span all columns by default. Use `->columnSpan()` or `->columnSpanFull()`:

```php
Section::make('Details')
    ->schema([
        // Fields
    ])
    ->columnSpanFull(), // Spans all columns
```

### Repeater Schema

Use `->schema()`, not `->fields()`:

```php
Repeater::make('items')
    ->schema([ // Correct
        TextInput::make('name'),
    ])
    // NOT ->fields([...])
```

### Dehydrated Fields

Never add `->dehydrated(false)` to fields that need to be saved. It strips the value from form state before `->action()` or the save handler runs. Only use it for helper/UI-only fields:

```php
TextInput::make('password_confirmation')
    ->password()
    ->dehydrated(false) // OK - just for UI validation
    ->required(),
```

## Common Pitfalls

- Using wrong namespaces for components (especially Actions)
- Not using `->visibility('public')` for files that need public access
- Assuming full-width layouts without explicit `->columnSpanFull()`
- Using `->dehydrated(false)` on fields that need to be saved
- Using `->fields()` instead of `->schema()` on Repeaters
- Forgetting to use `Get` and `Set` type hints for reactive form logic
- Not checking project conventions before creating resources

## Testing

```php
use function Pest\Livewire\livewire;
use function Pest\Laravel\assertDatabaseHas;

// Table test
livewire(ListUsers::class)
    ->assertCanSeeTableRecords($users)
    ->searchTable($users->first()->name)
    ->assertCanSeeTableRecords($users->take(1))
    ->assertCanNotSeeTableRecords($users->skip(1));

// Create resource test
livewire(CreateUser::class)
    ->fillForm([
        'name' => 'Test',
        'email' => 'test@example.com',
    ])
    ->call('create')
    ->assertNotified()
    ->assertHasNoFormErrors()
    ->assertRedirect();

assertDatabaseHas(User::class, [
    'name' => 'Test',
    'email' => 'test@example.com',
]);

// Edit resource test
livewire(EditUser::class, ['record' => $user->id])
    ->fillForm(['name' => 'Updated'])
    ->call('save')
    ->assertNotified()
    ->assertHasNoFormErrors();

// Testing validation
livewire(CreateUser::class)
    ->fillForm([
        'name' => null,
        'email' => 'invalid-email',
    ])
    ->call('create')
    ->assertHasFormErrors([
        'name' => 'required',
        'email' => 'email',
    ])
    ->assertNotNotified();

// Calling actions
livewire(ListUsers::class)
    ->callAction(TestAction::make('promote')->table($user), [
        'role' => 'admin',
    ])
    ->assertNotified();
```

## Enum Design System

Use PHP 8.1 backed string enums implementing Filament contracts for all statuses/types:

```php
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasColor, HasIcon, HasLabel
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Processing => 'Processing',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Processing => 'info',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Pending => 'heroicon-o-clock',
            self::Processing => 'heroicon-o-arrow-path',
            self::Completed => 'heroicon-o-check-circle',
            self::Cancelled => 'heroicon-o-x-circle',
        };
    }
}
```

**Semantic colors:** success (positive), danger (negative), warning (caution), info (new), primary (special), gray (neutral)

Cast in model: `'status' => OrderStatus::class`

## Multi-Tenancy

```php
// PanelProvider
return $panel
    ->tenant(Team::class)
    ->tenantRegistration(RegisterTeam::class)
    ->tenantProfile(EditTeamProfile::class);

// User model
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    public function getTenants(Panel $panel): array
    {
        return $this->teams->all();
    }

    public function canAccessTenant(Tenant $tenant): bool
    {
        return $this->teams->contains($tenant);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
```

**Critical:** Form selects NOT auto-scoped. Add `modifyQueryUsing`:

```php
Select::make('category_id')
    ->relationship('category', 'name')
    ->modifyQueryUsing(fn (Builder $query) => $query->where('team_id', Filament::getTenant()->id))
    ->searchable()
    ->preload(),
```

## Import & Export

```php
// app/Filament/Exports/ProductExporter.php
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),
            ExportColumn::make('price'),
            ExportColumn::make('category.name'),
        ];
    }
}

// app/Filament/Imports/ProductImporter.php
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('price')
                ->numeric()
                ->rules(['numeric', 'min:0']),
        ];
    }
}

// In resource table
->toolbarActions([
    Tables\Actions\ExportAction::make()
        ->exporter(ProductExporter::class),
    Tables\Actions\ImportAction::make()
        ->importer(ProductImporter::class),
])
```

## Authorization

**FilamentUser interface required in production:**

```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }
}
```

**Model policies auto-discovered:**

```php
class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->can('create posts');
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
```

Skip authorization in resource: `protected static bool $shouldSkipAuthorization = true;`

## Performance & Deployment

**Production optimization:**

```bash
php artisan optimize
php artisan filament:optimize
```

**Panel config:**

```php
return $panel
    ->spa() // SPA mode
    ->unsavedChangesAlerts() // Warn on unsaved changes
    ->databaseTransactions() // Wrap actions in DB transactions
    ->sidebarCollapsibleOnDesktop();
```

**Widget performance:**

```php
class StatsOverview extends StatsOverviewWidget
{
    protected static bool $isLazy = true; // Lazy loading (default)
    protected ?string $pollingInterval = '5s'; // Or null to disable
}
```

**Never run `filament:optimize` in local dev** -- new components won't be discovered.

## Strict Rules

- Never publish Blade views. Use CSS hooks with `fi-` prefix.
- Never hardcode brand names, logos, currency. Use settings.
- All user-facing text via language files, never hardcoded.
- `$recordTitleAttribute` set on every resource.
- Action modals: `->schema()` not `->form()`.
- Table: `recordActions()` not `actions()`, `groupedBulkActions()` not `bulkActions()`.
- Schema: `$schema->components([...])` at top level.
- Icons: `Heroicon::` enum only, never string names.
- Operation: `Operation::Create`, `Operation::Edit`, never string comparisons.

## Checklist

- [ ] Resource delegates to Schema and Table classes
- [ ] `$recordTitleAttribute` set on every resource
- [ ] `Heroicon::` enum for all icons, `Outlined` for navigation
- [ ] All actions from `Filament\Actions\*` namespace
- [ ] Table uses `recordActions()`, `groupedBulkActions()`, `toolbarActions()`
- [ ] Enums implement HasLabel, HasColor, HasIcon
- [ ] Form selects are searchable and preloaded
- [ ] Multi-tenant form selects manually scoped
- [ ] `FilamentUser` interface implemented with `canAccessPanel()`
- [ ] Model policies for authorization
- [ ] `filament:optimize` in production deploy
- [ ] Tests use `livewire()` with `Filament::setTenant()` for multi-tenant
- [ ] No hardcoded text -- all through language files
- [ ] No published Blade views -- CSS hooks only
