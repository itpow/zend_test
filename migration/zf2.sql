PGDMP     "    %                x            zf2_stud_news    12.3    12.3                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16583    zf2_stud_news    DATABASE     �   CREATE DATABASE zf2_stud_news WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Russian_Russia.1251' LC_CTYPE = 'Russian_Russia.1251';
    DROP DATABASE zf2_stud_news;
                postgres    false            �            1259    16584    news    TABLE     �   CREATE TABLE public.news (
    id bigint NOT NULL,
    time_create timestamp without time zone,
    time_update timestamp without time zone,
    title character varying(300),
    preview text,
    body_text text,
    publish boolean
);
    DROP TABLE public.news;
       public         heap    postgres    false            �            1259    16590    news_id_seq    SEQUENCE     t   CREATE SEQUENCE public.news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.news_id_seq;
       public          postgres    false    202            	           0    0    news_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;
          public          postgres    false    203            �
           2604    16592    news id    DEFAULT     b   ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);
 6   ALTER TABLE public.news ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    203    202                      0    16584    news 
   TABLE DATA           `   COPY public.news (id, time_create, time_update, title, preview, body_text, publish) FROM stdin;
    public          postgres    false    202   �
       
           0    0    news_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.news_id_seq', 20, true);
          public          postgres    false    203            �
           2606    16594    news news_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.news DROP CONSTRAINT news_pkey;
       public            postgres    false    202               p   x�34�4202�50�52V04�2��26г42�45�'ua�}6]�w��b�����{�B{/6*�P�;@r�.l���Ŕ+�2�D���������� �N,��=... 1�S�     