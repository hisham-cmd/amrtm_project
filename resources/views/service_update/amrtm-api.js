/**
 * amrtm-api.js
 * ─────────────────────────────────────────────────
 * Shared API helper used by ALL frontend pages.
 * Include this file in every HTML page:
 *   <script src="amrtm-api.js"></script>
 *
 * Base URL: change API_BASE to your Laravel server URL
 */

const API_BASE = 'http://localhost:8000/api/v1'; // ← change to your server

/* ══════════════════════════════════════
   CORE HTTP HELPER
══════════════════════════════════════ */
async function apiRequest(method, endpoint, data = null, isFormData = false) {
    const token = localStorage.getItem('amrtm_token');

    const headers = {};
    if (!isFormData) headers['Content-Type'] = 'application/json';
    if (token)       headers['Authorization'] = 'Bearer ' + token;
    headers['Accept'] = 'application/json';

    const options = { method, headers };
    if (data) options.body = isFormData ? data : JSON.stringify(data);

    try {
        const res = await fetch(API_BASE + endpoint, options);
        const json = await res.json();

        if (res.status === 401) {
            // Token expired
            localStorage.removeItem('amrtm_token');
            localStorage.removeItem('amrtm_user');
            if (!window.location.href.includes('amr_login')) {
                window.location.href = 'amr_login.html?redirect=' + encodeURIComponent(window.location.href);
            }
            return null;
        }

        if (!res.ok) {
            throw { status: res.status, data: json };
        }

        return json;
    } catch (err) {
        console.error('API Error:', err);
        throw err;
    }
}

const API = {
    get:    (url)        => apiRequest('GET',    url),
    post:   (url, data)  => apiRequest('POST',   url, data),
    put:    (url, data)  => apiRequest('PUT',    url, data),
    delete: (url)        => apiRequest('DELETE', url),
    upload: (url, form)  => apiRequest('POST',   url, form, true),
};

/* ══════════════════════════════════════
   AUTH
══════════════════════════════════════ */
const Auth = {
    async register(name, email, phone, password) {
        const res = await API.post('/register', { name, email, phone, password, password_confirmation: password });
        if (res) {
            localStorage.setItem('amrtm_token', res.token);
            localStorage.setItem('amrtm_user',  JSON.stringify(res.user));
        }
        return res;
    },

    async login(login, password) {
        const res = await API.post('/login', { login, password });
        if (res) {
            localStorage.setItem('amrtm_token', res.token);
            localStorage.setItem('amrtm_user',  JSON.stringify(res.user));
        }
        return res;
    },

    async logout() {
        try { await API.post('/logout'); } catch {}
        localStorage.removeItem('amrtm_token');
        localStorage.removeItem('amrtm_user');
        window.location.href = 'index.html';
    },

    isLoggedIn() {
        return !!localStorage.getItem('amrtm_token');
    },

    getUser() {
        try { return JSON.parse(localStorage.getItem('amrtm_user')); } catch { return null; }
    },

    isAdmin() {
        return this.getUser()?.role === 'admin';
    },

    async refreshUser() {
        const res = await API.get('/profile');
        if (res) localStorage.setItem('amrtm_user', JSON.stringify(res));
        return res;
    },

    requireLogin() {
        if (!this.isLoggedIn()) {
            window.location.href = 'amr_login.html?redirect=' + encodeURIComponent(window.location.href);
            return false;
        }
        return true;
    },

    requireAdmin() {
        if (!this.isLoggedIn() || !this.isAdmin()) {
            window.location.href = 'amr_login.html';
            return false;
        }
        return true;
    },
};

/* ══════════════════════════════════════
   SERVICES
══════════════════════════════════════ */
const Services = {
    async getAll() {
        return API.get('/services');
    },
    async getEntity(id) {
        return API.get('/entities/' + id);
    },
    async getService(id) {
        return API.get('/services/' + id);
    },
};

/* ══════════════════════════════════════
   REQUESTS
══════════════════════════════════════ */
const Requests = {
    async submit(formData) {
        // formData is a FormData object (supports file uploads)
        return API.upload('/requests', formData);
    },
    async myRequests(page = 1) {
        return API.get('/requests?page=' + page);
    },
    async getOne(id) {
        return API.get('/requests/' + id);
    },
};

/* ══════════════════════════════════════
   PAYMENTS
══════════════════════════════════════ */
const Payments = {
    async charge(amount) {
        return API.post('/payments/charge', { amount });
    },
    async history(page = 1) {
        return API.get('/payments/history?page=' + page);
    },
};

/* ══════════════════════════════════════
   DASHBOARD
══════════════════════════════════════ */
const Dashboard = {
    async userStats() {
        return API.get('/dashboard/user');
    },
    async adminStats() {
        return API.get('/dashboard/admin');
    },
};

/* ══════════════════════════════════════
   ADMIN
══════════════════════════════════════ */
const Admin = {
    // Requests
    async getRequests(status = 'all', search = '', page = 1) {
        return API.get(`/admin/requests?status=${status}&search=${search}&page=${page}`);
    },
    async updateStatus(id, status, rejectReason = '', estimatedTime = '') {
        return API.put(`/admin/requests/${id}/status`, {
            status,
            reject_reason: rejectReason,
            estimated_completion: estimatedTime,
        });
    },
    async setTime(id, time) {
        return API.put(`/admin/requests/${id}/time`, { estimated_completion: time });
    },

    // Services pricing
    async updatePrice(serviceId, price) {
        return API.put(`/admin/services/${serviceId}/price`, { price });
    },
    async updateService(id, data) {
        return API.put(`/admin/services/${id}`, data);
    },

    // Transactions
    async getTransactions(page = 1) {
        return API.get('/admin/payments?page=' + page);
    },
};

/* ══════════════════════════════════════
   PROFILE
══════════════════════════════════════ */
const Profile = {
    async update(data) {
        const res = await API.put('/profile', data);
        if (res) localStorage.setItem('amrtm_user', JSON.stringify(res));
        return res;
    },
    async uploadAvatar(file) {
        const form = new FormData();
        form.append('avatar', file);
        return API.upload('/profile/avatar', form);
    },
    async changePassword(currentPassword, newPassword) {
        return API.put('/profile/password', {
            current_password:      currentPassword,
            password:              newPassword,
            password_confirmation: newPassword,
        });
    },
};

/* ══════════════════════════════════════
   TOAST NOTIFICATIONS
══════════════════════════════════════ */
function showToast(message, type = 'success', duration = 3500) {
    const existing = document.getElementById('amrtm-toast');
    if (existing) existing.remove();

    const colors = {
        success : { bg: 'rgba(27,94,32,.95)',  icon: 'ti-circle-check' },
        error   : { bg: 'rgba(198,40,40,.95)', icon: 'ti-alert-circle'  },
        info    : { bg: 'rgba(26,35,126,.95)', icon: 'ti-info-circle'   },
        warning : { bg: 'rgba(230,81,0,.95)',  icon: 'ti-alert-triangle'},
    };
    const c = colors[type] || colors.info;

    const toast = document.createElement('div');
    toast.id = 'amrtm-toast';
    const lang = localStorage.getItem('amrtm_lang') || 'ar';
    toast.style.cssText = `
        position:fixed;bottom:24px;${lang==='ar'?'right':'left'}:24px;z-index:9999;
        background:${c.bg};color:#fff;padding:12px 18px;
        border-radius:12px;font-size:13.5px;font-weight:600;
        display:flex;align-items:center;gap:9px;
        box-shadow:0 8px 24px rgba(0,0,0,.25);
        animation:toastIn .3s ease;
        font-family:'Cairo',sans-serif;
        max-width:340px;
    `;
    toast.innerHTML = `<i class="ti ${c.icon}" style="font-size:18px;flex-shrink:0;"></i><span>${message}</span>`;

    const style = document.createElement('style');
    style.textContent = `@keyframes toastIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}`;
    document.head.appendChild(style);
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity .3s';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

/* ══════════════════════════════════════
   LOADING OVERLAY
══════════════════════════════════════ */
function showLoader() {
    if (document.getElementById('amrtm-loader')) return;
    const el = document.createElement('div');
    el.id = 'amrtm-loader';
    el.style.cssText = 'position:fixed;inset:0;z-index:9998;background:rgba(255,255,255,.7);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;';
    el.innerHTML = `<div style="width:44px;height:44px;border:4px solid rgba(26,35,126,.2);border-top-color:#1A237E;border-radius:50%;animation:spin .7s linear infinite;"></div>
    <style>@keyframes spin{to{transform:rotate(360deg)}}</style>`;
    document.body.appendChild(el);
}
function hideLoader() {
    document.getElementById('amrtm-loader')?.remove();
}

/* ══════════════════════════════════════
   CURRENCY FORMAT
══════════════════════════════════════ */
function formatSAR(amount, lang = 'ar') {
    const n = parseFloat(amount || 0).toFixed(2);
    return lang === 'ar' ? `${n} ر.س` : `${n} SAR`;
}

/* ══════════════════════════════════════
   DATE FORMAT
══════════════════════════════════════ */
function formatDate(dateStr, lang = 'ar') {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    return d.toLocaleDateString(lang === 'ar' ? 'ar-SA' : 'en-US', {
        year: 'numeric', month: 'long', day: 'numeric'
    });
}

/* Status color/label helper */
function statusInfo(status, lang = 'ar') {
    const map = {
        pending    : { ar: 'قيد الانتظار',   en: 'Pending',    color: '#E65100', bg: 'rgba(230,81,0,.1)'    },
        processing : { ar: 'جاري المعالجة',  en: 'Processing', color: '#0277BD', bg: 'rgba(2,119,189,.1)'   },
        in_progress: { ar: 'قيد التنفيذ',    en: 'In Progress',color: '#F9A825', bg: 'rgba(249,168,37,.1)'  },
        done       : { ar: 'تمت العملية',     en: 'Completed',  color: '#1B5E20', bg: 'rgba(27,94,32,.1)'   },
        rejected   : { ar: 'مرفوض',           en: 'Rejected',   color: '#C62828', bg: 'rgba(198,40,40,.1)'  },
    };
    const s = map[status] || { ar: '—', en: '—', color: '#999', bg: 'rgba(0,0,0,.05)' };
    return { label: s[lang] || s.ar, color: s.color, bg: s.bg };
}
