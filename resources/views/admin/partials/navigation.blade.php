<!-- Admin Navigation -->
<div style="display: flex; gap: 2rem; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid rgba(148,163,184,0.3);">
    <a href="{{ route('admin.dashboard') }}" 
       style="display: inline-flex; align-items: center; gap: 0.5rem; padding-bottom: 0.75rem; color: #cbd5f5; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; border-bottom: 3px solid {{ request()->routeIs('admin.dashboard') ? '#22d3ee' : 'transparent' }}; {{ request()->routeIs('admin.dashboard') ? 'color: #22d3ee;' : '' }}">
        📊 Dashboard
    </a>
    <a href="{{ route('admin.ruangan.index') }}" 
       style="display: inline-flex; align-items: center; gap: 0.5rem; padding-bottom: 0.75rem; color: #cbd5f5; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; border-bottom: 3px solid {{ request()->routeIs('admin.ruangan.*') ? '#22d3ee' : 'transparent' }}; {{ request()->routeIs('admin.ruangan.*') ? 'color: #22d3ee;' : '' }}">
        🏛️ Ruangan
    </a>
    <a href="{{ route('admin.booking.index') }}" 
       style="display: inline-flex; align-items: center; gap: 0.5rem; padding-bottom: 0.75rem; color: #cbd5f5; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; border-bottom: 3px solid {{ request()->routeIs('admin.booking.*') ? '#22d3ee' : 'transparent' }}; {{ request()->routeIs('admin.booking.*') ? 'color: #22d3ee;' : '' }}">
        📋 Booking
    </a>
    <a href="{{ route('admin.user.index') }}" 
       style="display: inline-flex; align-items: center; gap: 0.5rem; padding-bottom: 0.75rem; color: #cbd5f5; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; border-bottom: 3px solid {{ request()->routeIs('admin.user.*') ? '#22d3ee' : 'transparent' }}; {{ request()->routeIs('admin.user.*') ? 'color: #22d3ee;' : '' }}">
        👥 User
    </a>
</div>
