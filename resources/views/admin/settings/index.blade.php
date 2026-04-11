@extends('layouts.admin')

@section('title', 'Cài đặt website')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Cài đặt website</h4>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf

    {{-- Hero --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-semibold">Hero Section</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Tiêu đề chính (hero_headline)</label>
                <input type="text" name="hero_headline" class="form-control @error('hero_headline') is-invalid @enderror"
                    value="{{ old('hero_headline', $settings['hero_headline']->value ?? '') }}">
                @error('hero_headline')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả ngắn (hero_description)</label>
                <textarea name="hero_description" rows="3" class="form-control @error('hero_description') is-invalid @enderror">{{ old('hero_description', $settings['hero_description']->value ?? '') }}</textarea>
                @error('hero_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh nền Hero (hero_bg_image)</label>
                <x-admin.image-preview :path="$settings['hero_bg_image']->value ?? null" />
                <input type="file" name="hero_bg_image" class="form-control @error('hero_bg_image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                @error('hero_bg_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- About Teaser --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-semibold">About Teaser</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Ảnh About (about_image)</label>
                <x-admin.image-preview :path="$settings['about_image']->value ?? null" />
                <input type="file" name="about_image" class="form-control @error('about_image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                @error('about_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung About (about_text)</label>
                <textarea name="about_text" rows="4" class="form-control @error('about_text') is-invalid @enderror">{{ old('about_text', $settings['about_text']->value ?? '') }}</textarea>
                @error('about_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nhãn thống kê (about_stat_label)</label>
                    <input type="text" name="about_stat_label" class="form-control @error('about_stat_label') is-invalid @enderror"
                        value="{{ old('about_stat_label', $settings['about_stat_label']->value ?? '') }}">
                    @error('about_stat_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Giá trị thống kê (about_stat_value)</label>
                    <input type="text" name="about_stat_value" class="form-control @error('about_stat_value') is-invalid @enderror"
                        value="{{ old('about_stat_value', $settings['about_stat_value']->value ?? '') }}">
                    @error('about_stat_value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Banner --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-semibold">CTA Banner</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Tiêu đề CTA (cta_heading)</label>
                <input type="text" name="cta_heading" class="form-control @error('cta_heading') is-invalid @enderror"
                    value="{{ old('cta_heading', $settings['cta_heading']->value ?? '') }}">
                @error('cta_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả CTA (cta_description)</label>
                <textarea name="cta_description" rows="3" class="form-control @error('cta_description') is-invalid @enderror">{{ old('cta_description', $settings['cta_description']->value ?? '') }}</textarea>
                @error('cta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- Contact Info --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-semibold">Thông tin liên hệ</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Địa chỉ (contact_address)</label>
                <input type="text" name="contact_address" class="form-control @error('contact_address') is-invalid @enderror"
                    value="{{ old('contact_address', $settings['contact_address']->value ?? '') }}">
                @error('contact_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email (contact_email)</label>
                <input type="text" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror"
                    value="{{ old('contact_email', $settings['contact_email']->value ?? '') }}">
                @error('contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Điện thoại (contact_phone)</label>
                <input type="text" name="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror"
                    value="{{ old('contact_phone', $settings['contact_phone']->value ?? '') }}">
                @error('contact_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-semibold">Footer</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Mô tả footer (footer_description)</label>
                <textarea name="footer_description" rows="3" class="form-control @error('footer_description') is-invalid @enderror">{{ old('footer_description', $settings['footer_description']->value ?? '') }}</textarea>
                @error('footer_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">LinkedIn URL (social_linkedin)</label>
                <input type="text" name="social_linkedin" class="form-control @error('social_linkedin') is-invalid @enderror"
                    value="{{ old('social_linkedin', $settings['social_linkedin']->value ?? '') }}">
                @error('social_linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Facebook URL (social_facebook)</label>
                <input type="text" name="social_facebook" class="form-control @error('social_facebook') is-invalid @enderror"
                    value="{{ old('social_facebook', $settings['social_facebook']->value ?? '') }}">
                @error('social_facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">YouTube URL (social_youtube)</label>
                <input type="text" name="social_youtube" class="form-control @error('social_youtube') is-invalid @enderror"
                    value="{{ old('social_youtube', $settings['social_youtube']->value ?? '') }}">
                @error('social_youtube')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- About Page --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-semibold">Trang About</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Nội dung trang About (about_page_content)</label>
                <textarea name="about_page_content" rows="8" class="form-control @error('about_page_content') is-invalid @enderror">{{ old('about_page_content', $settings['about_page_content']->value ?? '') }}</textarea>
                @error('about_page_content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- General --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white fw-semibold">Thông tin chung</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Tên công ty (company_name)</label>
                <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
                    value="{{ old('company_name', $settings['company_name']->value ?? '') }}">
                @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Logo công ty (company_logo)</label>
                <x-admin.image-preview :path="$settings['company_logo']->value ?? null" />
                <input type="file" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                @error('company_logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Meta description mặc định (meta_description_default)</label>
                <textarea name="meta_description_default" rows="2" class="form-control @error('meta_description_default') is-invalid @enderror">{{ old('meta_description_default', $settings['meta_description_default']->value ?? '') }}</textarea>
                @error('meta_description_default')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Lưu cài đặt
        </button>
    </div>
</form>
@endsection
