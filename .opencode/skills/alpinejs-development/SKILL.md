---
name: alpinejs-development
description: "Use for any task or question involving Alpine.js. Activate if user mentions Alpine.js directives (x-data, x-show, x-bind, x-on, etc.), reactive state management, transitions, or client-side interactions that require Alpine.js specifically. Covers building interactive UI components without page reloads, toggling visibility, event handling, data binding, and integrating with Livewire. Do not use for pure Livewire tasks, React, Vue, or vanilla JavaScript without Alpine.js patterns."
license: MIT
metadata:
  author: laravel
---

# Alpine.js Development

## Documentation

Use `search-docs` for detailed Alpine.js patterns and documentation.

## Basic Usage

### Core Directives

Alpine.js uses directives to add behavior to HTML elements:

| Directive | Purpose | Example |
|-----------|---------|---------|
| `x-data` | Define component data and methods | `<div x-data="{ count: 0 }">` |
| `x-show` | Toggle visibility (display: none) | `<div x-show="open">` |
| `x-if` | Conditional rendering (removes from DOM) | `<template x-if="open">` |
| `x-bind` | Bind attributes to data | `:class`, `:disabled`, `:src` |
| `x-on` / `@` | Event listeners | `@click="increment"` |
| `x-model` | Two-way data binding | `<input x-model="name">` |
| `x-text` / `x-html` | Set text/HTML content | `<span x-text="message">` |
| `x-for` | Loop over arrays/objects | `<template x-for="item in items">` |
| `x-transition` | Add animations | `x-transition:enter="..."` |
| `x-init` | Run code on initialization | `x-init="fetchData()"` |
| `x-effect` | Reactive side effects | `x-effect="console.log(count)"` |
| `x-ref` | Reference elements | `<input x-ref="input">` |

### Component Example

```html
<div x-data="{
    open: false,
    items: [],
    toggle() {
        this.open = !this.open;
    },
    addItem(text) {
        this.items.push(text);
    }
}">
    <button @click="toggle()" x-text="open ? 'Close' : 'Open'"></button>
    
    <div x-show="open" x-transition>
        <ul>
            <template x-for="item in items" :key="item">
                <li x-text="item"></li>
            </template>
        </ul>
    </div>
</div>
```

### Attribute Binding (x-bind / :)

Shorthand for `x-bind:` is `:`:

```html
<!-- Long form -->
<button x-bind:disabled="isLoading">Submit</button>

<!-- Shorthand -->
<button :disabled="isLoading">Submit</button>

<!-- Class binding with object syntax -->
<button :class="{ 'bg-blue-500': active, 'bg-gray-500': !active }">
    Toggle
</button>

<!-- Style binding -->
<div :style="{ backgroundColor: color, fontSize: size + 'px' }"></div>
```

### Event Handling (x-on / @)

Shorthand for `x-on:` is `@`:

```html
<!-- Click event -->
<button @click="count++">Increment</button>

<!-- Event modifiers -->
<form @submit.prevent="submitForm()">
<button @click.stop="handleClick()">
<input @keydown.escape="close()">
<input @keydown.enter.prevent="submit()">

<!-- Key modifiers -->
<input @keydown.ctrl.k="showSearch()">
<input @keydown.shift.enter="submit()">

<!-- Once modifier -->
<button @click.once="init()">Initialize</button>

<!-- Outside click -->
<div @click.outside="close()">Modal</div>
```

### Two-Way Binding (x-model)

```html
<!-- Basic binding -->
<input x-model="name" type="text">

<!-- Modifiers -->
<input x-model.lazy="search">     <!-- Updates on change/blur, not input -->
<input x-model.number="quantity"> <!-- Converts to number -->
<input x-model.trim="username">   <!-- Trims whitespace -->
<input x-model.debounce="query">  <!-- Debounces updates (default 250ms) -->
<input x-model.debounce.500ms="query"> <!-- Custom debounce time -->
```

### Transitions

```html
<!-- Simple fade -->
<div x-show="open" x-transition>Content</div>

<!-- Custom transitions with Tailwind -->
<div x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95">
    Modal content
</div>
```

## Advanced Patterns

### Magic Properties

Alpine.js provides magic properties accessible with `$` prefix:

```html
<div x-data="{ items: [1, 2, 3] }">
    <!-- $el - Reference to the current DOM element -->
    <button @click="$el.style.color = 'red'">Red</button>
    
    <!-- $refs - Access referenced elements -->
    <input x-ref="input" type="text">
    <button @click="$refs.input.focus()">Focus</button>
    
    <!-- $store - Access global store -->
    <span x-text="$store.user.name"></span>
    
    <!-- $watch - Watch for changes -->
    <div x-init="$watch('items', value => console.log(value))"></div>
    
    <!-- $nextTick - Run after DOM update -->
    <button @click="items.push(4); $nextTick(() => console.log('updated'))">Add</button>
    
    <!-- $dispatch - Dispatch custom events -->
    <button @click="$dispatch('notify', { message: 'Hello!' })">Notify</button>
</div>
```

### Global Store (Alpine.store)

Define a global reactive store:

```javascript
// In your app.js or a script tag
document.addEventListener('alpine:init', () => {
    Alpine.store('user', {
        name: 'John',
        isLoggedIn: false,
        
        login(name) {
            this.name = name;
            this.isLoggedIn = true;
        },
        
        logout() {
            this.isLoggedIn = false;
        }
    });
});
```

Access in templates:
```html
<div x-data>
    <span x-show="$store.user.isLoggedIn" x-text="$store.user.name"></span>
    <button @click="$store.user.logout()">Logout</button>
</div>
```

### Reusable Components (Data)

Create reusable data logic:

```javascript
// In app.js or inline
document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', () => ({
        open: false,
        
        toggle() {
            this.open = !this.open;
        },
        
        close() {
            this.open = false;
        }
    }));
});
```

Use in templates:
```html
<div x-data="dropdown">
    <button @click="toggle()">Menu</button>
    <div x-show="open" @click.outside="close()">
        <!-- Dropdown content -->
    </div>
</div>
```

## Integration with Livewire

Alpine.js is included with Livewire 4. Use them together:

```html
<!-- Access Livewire component from Alpine -->
<div x-data="{
    init() {
        // Listen to Livewire events
        this.$wire.on('post-saved', () => {
            this.showNotification = true;
        });
    }
}">
    <button @click="$wire.save()">Save</button>
    <div x-show="showNotification" x-transition>Saved!</div>
</div>

<!-- Two-way binding with Livewire -->
<input x-model="$wire.title" type="text">

<!-- Entangle for reactive sync -->
<div x-data="{ open: @entangle('modalOpen') }">
    <div x-show="open">Modal content</div>
</div>
```

## Common Patterns

### Modal/Dialog

```html
<div x-data="{ open: false }" @keydown.escape.window="open = false">
    <button @click="open = true">Open Modal</button>
    
    <div x-show="open" 
         class="fixed inset-0 bg-black bg-opacity-50"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.outside="open = false"
             class="bg-white p-6 rounded-lg max-w-lg mx-auto mt-20"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100">
            <h2>Modal Title</h2>
            <button @click="open = false">Close</button>
        </div>
    </div>
</div>
```

### Accordion

```html
<div x-data="{ active: null }">
    <template x-for="(item, index) in items" :key="index">
        <div>
            <button @click="active = active === index ? null : index"
                    :aria-expanded="active === index">
                <span x-text="item.title"></span>
                <span :class="{ 'rotate-180': active === index }">▼</span>
            </button>
            <div x-show="active === index" x-collapse>
                <p x-text="item.content"></p>
            </div>
        </div>
    </template>
</div>
```

### Tabs

```html
<div x-data="{ activeTab: 'general' }">
    <div role="tablist">
        <button @click="activeTab = 'general'" 
                :class="{ 'border-b-2 border-blue-500': activeTab === 'general' }">
            General
        </button>
        <button @click="activeTab = 'settings'"
                :class="{ 'border-b-2 border-blue-500': activeTab === 'settings' }">
            Settings
        </button>
    </div>
    
    <div x-show="activeTab === 'general'">General content</div>
    <div x-show="activeTab === 'settings'">Settings content</div>
</div>
```

### Dropdown Menu

```html
<div x-data="{ open: false }" @keydown.escape.window="open = false">
    <button @click="open = !open" @click.outside="open = false">
        Options
    </button>
    
    <div x-show="open" x-transition:enter="transition ease-out duration-100">
        <a href="#" @click="open = false">Edit</a>
        <a href="#" @click="open = false">Delete</a>
    </div>
</div>
```

### Search with Debounce

```html
<div x-data="{
    query: '',
    results: [],
    async search() {
        if (this.query.length < 2) return;
        const response = await fetch(`/api/search?q=${this.query}`);
        this.results = await response.json();
    }
}">
    <input x-model="query" 
           @input.debounce.300ms="search()"
           type="search"
           placeholder="Search...">
    
    <ul x-show="results.length > 0">
        <template x-for="result in results" :key="result.id">
            <li x-text="result.name"></li>
        </template>
    </ul>
</div>
```

## Best Practices

- **Keep logic simple**: Alpine is for lightweight interactivity. Complex logic belongs in Livewire or vanilla JS.
- **Use appropriate directives**: Prefer `x-show` for toggling visibility; use `x-if` only when you need to remove from DOM.
- **Event delegation**: Use `.window` or `.document` modifiers for global events: `@keydown.escape.window`.
- **Accessibility**: Add appropriate ARIA attributes when building interactive components.
- **Performance**: Avoid deep nesting of Alpine components. Use `x-init` for one-time setup, `x-effect` for reactive side effects.
- **State management**: Use `$store` for global state, component data for local state.

## Common Pitfalls

- Forgetting `x-cloak` directive for elements that should be hidden on page load before Alpine initializes
- Using `x-if` when `x-show` would suffice (x-if is more expensive)
- Not using `:key` with `x-for` when list items can change order
- Modifying arrays/objects without triggering reactivity (use array methods, not direct assignment)
- Forgetting that Alpine is already bundled with Livewire 4 (don't include it separately)

## Verification

1. Check browser console for Alpine.js errors
2. Verify directives are spelled correctly (typos won't error but won't work)
3. Test reactivity by manually changing data in console: `Alpine.evaluate($0, 'count')`
4. Use browser devtools Alpine.js extension for debugging

## Plugins

Alpine.js supports official plugins for common needs:
- **Collapse**: `x-collapse` for height-based transitions
- **Focus**: Focus trapping for modals
- **Intersect**: `x-intersect` for viewport detection
- **Persist**: `$persist` for localStorage/state persistence
- **Mask**: `x-mask` for input masking

Import plugins in your bundle or via CDN before Alpine initializes.
