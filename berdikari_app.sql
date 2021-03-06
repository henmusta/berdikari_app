PGDMP              	            y            berdikari_app    13.3    13.3 T    H           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            I           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            J           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            K           1262    25805    berdikari_app    DATABASE     p   CREATE DATABASE berdikari_app WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Indonesian_Indonesia.1252';
    DROP DATABASE berdikari_app;
                postgres    false            ?            1259    26177 #   administrators_administrator_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.administrators_administrator_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 :   DROP SEQUENCE public.administrators_administrator_id_seq;
       public          postgres    false            ?            1259    25836    administrators    TABLE     f  CREATE TABLE public.administrators (
    administrator_id integer DEFAULT nextval('public.administrators_administrator_id_seq'::regclass) NOT NULL,
    username character(30) NOT NULL,
    password character varying NOT NULL,
    status character(12) DEFAULT 'active'::bpchar NOT NULL,
    fullname character varying NOT NULL,
    photo character varying
);
 "   DROP TABLE public.administrators;
       public         heap    postgres    false    213            ?            1259    26182    ads_ads_id_seq    SEQUENCE     w   CREATE SEQUENCE public.ads_ads_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.ads_ads_id_seq;
       public          postgres    false            ?            1259    25848    ads    TABLE     ?  CREATE TABLE public.ads (
    ads_id integer DEFAULT nextval('public.ads_ads_id_seq'::regclass) NOT NULL,
    title character varying NOT NULL,
    "position" character varying NOT NULL,
    type character varying(20) NOT NULL,
    value character varying,
    permalink character varying,
    target character varying(15) DEFAULT NULL::character varying,
    others character varying
);
    DROP TABLE public.ads;
       public         heap    postgres    false    214            ?            1259    26167    authors    TABLE     ?   CREATE TABLE public.authors (
    author_id integer NOT NULL,
    fullname character varying NOT NULL,
    photo character varying,
    slug character varying(255) DEFAULT NULL::character varying
);
    DROP TABLE public.authors;
       public         heap    postgres    false            ?            1259    26162    authors_author_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.authors_author_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.authors_author_id_seq;
       public          postgres    false    212            L           0    0    authors_author_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.authors_author_id_seq OWNED BY public.authors.author_id;
          public          postgres    false    211            ?            1259    26185    categories_category_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.categories_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.categories_category_id_seq;
       public          postgres    false            ?            1259    25870 
   categories    TABLE       CREATE TABLE public.categories (
    category_id integer DEFAULT nextval('public.categories_category_id_seq'::regclass) NOT NULL,
    parent_id integer,
    slug character varying,
    title character varying,
    description character varying,
    keywords character varying
);
    DROP TABLE public.categories;
       public         heap    postgres    false    215            ?            1259    26195    contacts_contact_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.contacts_contact_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.contacts_contact_id_seq;
       public          postgres    false            ?            1259    33985 
   employment    TABLE     ?   CREATE TABLE public.employment (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    sort integer,
    location character varying(255) DEFAULT NULL::character varying,
    show integer
);
    DROP TABLE public.employment;
       public         heap    postgres    false            ?            1259    33998    employment_id_seq    SEQUENCE     z   CREATE SEQUENCE public.employment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.employment_id_seq;
       public          postgres    false    221            M           0    0    employment_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.employment_id_seq OWNED BY public.employment.id;
          public          postgres    false    222            ?            1259    25887 
   guestbooks    TABLE     ?  CREATE TABLE public.guestbooks (
    guestbook_id integer DEFAULT nextval('public.contacts_contact_id_seq'::regclass) NOT NULL,
    name character varying,
    email character varying,
    phone character varying,
    subject character varying,
    message text,
    date_create timestamp without time zone DEFAULT '2021-09-01 05:47:06.410299'::timestamp without time zone,
    status character varying DEFAULT 'unread'::character varying
);
    DROP TABLE public.guestbooks;
       public         heap    postgres    false    216            ?            1259    26198    menu_menu_id_seq    SEQUENCE     y   CREATE SEQUENCE public.menu_menu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.menu_menu_id_seq;
       public          postgres    false            ?            1259    25903    menu    TABLE     ?  CREATE TABLE public.menu (
    menu_id integer DEFAULT nextval('public.menu_menu_id_seq'::regclass) NOT NULL,
    parent_id integer DEFAULT 0 NOT NULL,
    menu_type character varying(255) DEFAULT NULL::character varying,
    sort smallint NOT NULL,
    icon character varying(255),
    title character varying(255) NOT NULL,
    url text NOT NULL,
    target character varying(20) NOT NULL
);
    DROP TABLE public.menu;
       public         heap    postgres    false    217            ?            1259    25943    post_category_relations    TABLE     p   CREATE TABLE public.post_category_relations (
    post_id integer NOT NULL,
    category_id integer NOT NULL
);
 +   DROP TABLE public.post_category_relations;
       public         heap    postgres    false            ?            1259    26079 
   post_count    TABLE     ?   CREATE TABLE public.post_count (
    post_id integer NOT NULL,
    read_count integer,
    share_count_facebook integer,
    share_count_twitter integer,
    share_count_whatsapp integer
);
    DROP TABLE public.post_count;
       public         heap    postgres    false            ?            1259    26089    post_images    TABLE     +  CREATE TABLE public.post_images (
    post_image_id integer NOT NULL,
    post_id integer,
    source character varying NOT NULL,
    caption character varying,
    sort_order smallint,
    date_upload timestamp without time zone DEFAULT '2021-09-01 05:54:38.639645'::timestamp without time zone
);
    DROP TABLE public.post_images;
       public         heap    postgres    false            ?            1259    33956    post_images_post_image_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.post_images_post_image_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.post_images_post_image_id_seq;
       public          postgres    false    208            N           0    0    post_images_post_image_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.post_images_post_image_id_seq OWNED BY public.post_images.post_image_id;
          public          postgres    false    218            ?            1259    25922    posts    TABLE     ?  CREATE TABLE public.posts (
    post_id integer NOT NULL,
    author_id integer DEFAULT 1,
    administrator_id integer DEFAULT 1,
    module character(20) NOT NULL,
    slug character varying NOT NULL,
    title character varying NOT NULL,
    synopsis character varying,
    keywords character varying,
    content text,
    media_type character varying NOT NULL,
    media_source character varying,
    media_caption character varying,
    date_create timestamp without time zone NOT NULL,
    date_publish timestamp without time zone NOT NULL,
    date_modified timestamp without time zone NOT NULL,
    status character(12) NOT NULL,
    others character varying,
    publish_socmed character(1) DEFAULT '0'::bpchar
);
    DROP TABLE public.posts;
       public         heap    postgres    false            ?            1259    34022    posts_post_id_seq    SEQUENCE     z   CREATE SEQUENCE public.posts_post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.posts_post_id_seq;
       public          postgres    false    205            O           0    0    posts_post_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.posts_post_id_seq OWNED BY public.posts.post_id;
          public          postgres    false    225            ?            1259    34004    redaksi    TABLE     @  CREATE TABLE public.redaksi (
    redaksi_id integer NOT NULL,
    fullname character varying NOT NULL,
    photo character varying NOT NULL,
    pos_id integer,
    location character varying(255) DEFAULT 'NULL::character varying'::character varying,
    phone character varying(255) DEFAULT NULL::character varying
);
    DROP TABLE public.redaksi;
       public         heap    postgres    false            ?            1259    34017    redaksi_redaksi_id_seq    SEQUENCE        CREATE SEQUENCE public.redaksi_redaksi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.redaksi_redaksi_id_seq;
       public          postgres    false    223            P           0    0    redaksi_redaksi_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.redaksi_redaksi_id_seq OWNED BY public.redaksi.redaksi_id;
          public          postgres    false    224            ?            1259    26114    session_read_post    TABLE     ?   CREATE TABLE public.session_read_post (
    session_read_id integer NOT NULL,
    post_id integer,
    session_id character varying(100) DEFAULT NULL::character varying,
    read_time numeric
);
 %   DROP TABLE public.session_read_post;
       public         heap    postgres    false            ?            1259    33962 %   session_read_post_session_read_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.session_read_post_session_read_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 <   DROP SEQUENCE public.session_read_post_session_read_id_seq;
       public          postgres    false    209            Q           0    0 %   session_read_post_session_read_id_seq    SEQUENCE OWNED BY     o   ALTER SEQUENCE public.session_read_post_session_read_id_seq OWNED BY public.session_read_post.session_read_id;
          public          postgres    false    219            ?            1259    26123    settings    TABLE     ?   CREATE TABLE public.settings (
    setting_id integer NOT NULL,
    keyword character varying,
    value text,
    type character varying DEFAULT 'text'::character varying NOT NULL
);
    DROP TABLE public.settings;
       public         heap    postgres    false            ?            1259    33965    settings_setting_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.settings_setting_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.settings_setting_id_seq;
       public          postgres    false    210            R           0    0    settings_setting_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.settings_setting_id_seq OWNED BY public.settings.setting_id;
          public          postgres    false    220            ?           2604    26176    authors author_id    DEFAULT     v   ALTER TABLE ONLY public.authors ALTER COLUMN author_id SET DEFAULT nextval('public.authors_author_id_seq'::regclass);
 @   ALTER TABLE public.authors ALTER COLUMN author_id DROP DEFAULT;
       public          postgres    false    211    212    212            ?           2604    34000    employment id    DEFAULT     n   ALTER TABLE ONLY public.employment ALTER COLUMN id SET DEFAULT nextval('public.employment_id_seq'::regclass);
 <   ALTER TABLE public.employment ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221            ?           2604    33958    post_images post_image_id    DEFAULT     ?   ALTER TABLE ONLY public.post_images ALTER COLUMN post_image_id SET DEFAULT nextval('public.post_images_post_image_id_seq'::regclass);
 H   ALTER TABLE public.post_images ALTER COLUMN post_image_id DROP DEFAULT;
       public          postgres    false    218    208            ?           2604    34024    posts post_id    DEFAULT     n   ALTER TABLE ONLY public.posts ALTER COLUMN post_id SET DEFAULT nextval('public.posts_post_id_seq'::regclass);
 <   ALTER TABLE public.posts ALTER COLUMN post_id DROP DEFAULT;
       public          postgres    false    225    205            ?           2604    34019    redaksi redaksi_id    DEFAULT     x   ALTER TABLE ONLY public.redaksi ALTER COLUMN redaksi_id SET DEFAULT nextval('public.redaksi_redaksi_id_seq'::regclass);
 A   ALTER TABLE public.redaksi ALTER COLUMN redaksi_id DROP DEFAULT;
       public          postgres    false    224    223            ?           2604    33964 !   session_read_post session_read_id    DEFAULT     ?   ALTER TABLE ONLY public.session_read_post ALTER COLUMN session_read_id SET DEFAULT nextval('public.session_read_post_session_read_id_seq'::regclass);
 P   ALTER TABLE public.session_read_post ALTER COLUMN session_read_id DROP DEFAULT;
       public          postgres    false    219    209            ?           2604    33967    settings setting_id    DEFAULT     z   ALTER TABLE ONLY public.settings ALTER COLUMN setting_id SET DEFAULT nextval('public.settings_setting_id_seq'::regclass);
 B   ALTER TABLE public.settings ALTER COLUMN setting_id DROP DEFAULT;
       public          postgres    false    220    210            ,          0    25836    administrators 
   TABLE DATA           g   COPY public.administrators (administrator_id, username, password, status, fullname, photo) FROM stdin;
    public          postgres    false    200   ?i       -          0    25848    ads 
   TABLE DATA           `   COPY public.ads (ads_id, title, "position", type, value, permalink, target, others) FROM stdin;
    public          postgres    false    201   Rl       8          0    26167    authors 
   TABLE DATA           C   COPY public.authors (author_id, fullname, photo, slug) FROM stdin;
    public          postgres    false    212   xq       .          0    25870 
   categories 
   TABLE DATA           `   COPY public.categories (category_id, parent_id, slug, title, description, keywords) FROM stdin;
    public          postgres    false    202   Uv       A          0    33985 
   employment 
   TABLE DATA           D   COPY public.employment (id, nama, sort, location, show) FROM stdin;
    public          postgres    false    221   ?x       /          0    25887 
   guestbooks 
   TABLE DATA           m   COPY public.guestbooks (guestbook_id, name, email, phone, subject, message, date_create, status) FROM stdin;
    public          postgres    false    203   ?y       0          0    25903    menu 
   TABLE DATA           ]   COPY public.menu (menu_id, parent_id, menu_type, sort, icon, title, url, target) FROM stdin;
    public          postgres    false    204   z       2          0    25943    post_category_relations 
   TABLE DATA           G   COPY public.post_category_relations (post_id, category_id) FROM stdin;
    public          postgres    false    206   ~|       3          0    26079 
   post_count 
   TABLE DATA           z   COPY public.post_count (post_id, read_count, share_count_facebook, share_count_twitter, share_count_whatsapp) FROM stdin;
    public          postgres    false    207   ?|       4          0    26089    post_images 
   TABLE DATA           g   COPY public.post_images (post_image_id, post_id, source, caption, sort_order, date_upload) FROM stdin;
    public          postgres    false    208   ?|       1          0    25922    posts 
   TABLE DATA           ?   COPY public.posts (post_id, author_id, administrator_id, module, slug, title, synopsis, keywords, content, media_type, media_source, media_caption, date_create, date_publish, date_modified, status, others, publish_socmed) FROM stdin;
    public          postgres    false    205   ?|       C          0    34004    redaksi 
   TABLE DATA           W   COPY public.redaksi (redaksi_id, fullname, photo, pos_id, location, phone) FROM stdin;
    public          postgres    false    223   ?~       5          0    26114    session_read_post 
   TABLE DATA           \   COPY public.session_read_post (session_read_id, post_id, session_id, read_time) FROM stdin;
    public          postgres    false    209   ?~       6          0    26123    settings 
   TABLE DATA           D   COPY public.settings (setting_id, keyword, value, type) FROM stdin;
    public          postgres    false    210          S           0    0 #   administrators_administrator_id_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public.administrators_administrator_id_seq', 1, false);
          public          postgres    false    213            T           0    0    ads_ads_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.ads_ads_id_seq', 1, false);
          public          postgres    false    214            U           0    0    authors_author_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.authors_author_id_seq', 2, true);
          public          postgres    false    211            V           0    0    categories_category_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.categories_category_id_seq', 9, true);
          public          postgres    false    215            W           0    0    contacts_contact_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.contacts_contact_id_seq', 1, false);
          public          postgres    false    216            X           0    0    employment_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.employment_id_seq', 20, true);
          public          postgres    false    222            Y           0    0    menu_menu_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.menu_menu_id_seq', 1, false);
          public          postgres    false    217            Z           0    0    post_images_post_image_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.post_images_post_image_id_seq', 1, false);
          public          postgres    false    218            [           0    0    posts_post_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.posts_post_id_seq', 6, true);
          public          postgres    false    225            \           0    0    redaksi_redaksi_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.redaksi_redaksi_id_seq', 83, true);
          public          postgres    false    224            ]           0    0 %   session_read_post_session_read_id_seq    SEQUENCE SET     T   SELECT pg_catalog.setval('public.session_read_post_session_read_id_seq', 1, false);
          public          postgres    false    219            ^           0    0    settings_setting_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.settings_setting_id_seq', 1, false);
          public          postgres    false    220            ?           2606    25844 "   administrators administrators_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.administrators
    ADD CONSTRAINT administrators_pkey PRIMARY KEY (administrator_id);
 L   ALTER TABLE ONLY public.administrators DROP CONSTRAINT administrators_pkey;
       public            postgres    false    200            ?           2606    26175    authors authors_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.authors
    ADD CONSTRAINT authors_pkey PRIMARY KEY (author_id);
 >   ALTER TABLE ONLY public.authors DROP CONSTRAINT authors_pkey;
       public            postgres    false    212            ?           2606    25877    categories categories_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (category_id);
 D   ALTER TABLE ONLY public.categories DROP CONSTRAINT categories_pkey;
       public            postgres    false    202            ?           2606    33993    employment employment_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.employment
    ADD CONSTRAINT employment_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.employment DROP CONSTRAINT employment_pkey;
       public            postgres    false    221            ?           2606    25912    menu menu_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.menu
    ADD CONSTRAINT menu_pkey PRIMARY KEY (menu_id);
 8   ALTER TABLE ONLY public.menu DROP CONSTRAINT menu_pkey;
       public            postgres    false    204            ?           2606    26083    post_count post_count_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.post_count
    ADD CONSTRAINT post_count_pkey PRIMARY KEY (post_id);
 D   ALTER TABLE ONLY public.post_count DROP CONSTRAINT post_count_pkey;
       public            postgres    false    207            ?           2606    25932    posts posts_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (post_id);
 :   ALTER TABLE ONLY public.posts DROP CONSTRAINT posts_pkey;
       public            postgres    false    205            ?           2606    26122 (   session_read_post session_read_post_pkey 
   CONSTRAINT     s   ALTER TABLE ONLY public.session_read_post
    ADD CONSTRAINT session_read_post_pkey PRIMARY KEY (session_read_id);
 R   ALTER TABLE ONLY public.session_read_post DROP CONSTRAINT session_read_post_pkey;
       public            postgres    false    209            ?           2606    34012    redaksi FK_redaksi_employment    FK CONSTRAINT     ?   ALTER TABLE ONLY public.redaksi
    ADD CONSTRAINT "FK_redaksi_employment" FOREIGN KEY (pos_id) REFERENCES public.employment(id) ON UPDATE CASCADE ON DELETE CASCADE;
 I   ALTER TABLE ONLY public.redaksi DROP CONSTRAINT "FK_redaksi_employment";
       public          postgres    false    221    223    2979            ?           2606    25946 @   post_category_relations post_category_relations_category_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.post_category_relations
    ADD CONSTRAINT post_category_relations_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(category_id) ON UPDATE CASCADE ON DELETE CASCADE;
 j   ALTER TABLE ONLY public.post_category_relations DROP CONSTRAINT post_category_relations_category_id_fkey;
       public          postgres    false    2967    206    202            ?           2606    25951 <   post_category_relations post_category_relations_post_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.post_category_relations
    ADD CONSTRAINT post_category_relations_post_id_fkey FOREIGN KEY (post_id) REFERENCES public.posts(post_id) ON UPDATE CASCADE ON DELETE CASCADE;
 f   ALTER TABLE ONLY public.post_category_relations DROP CONSTRAINT post_category_relations_post_id_fkey;
       public          postgres    false    206    205    2971            ?           2606    26084 "   post_count post_count_post_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.post_count
    ADD CONSTRAINT post_count_post_id_fkey FOREIGN KEY (post_id) REFERENCES public.posts(post_id) ON UPDATE CASCADE ON DELETE CASCADE;
 L   ALTER TABLE ONLY public.post_count DROP CONSTRAINT post_count_post_id_fkey;
       public          postgres    false    2971    205    207            ?           2606    26096 $   post_images post_images_post_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_post_id_fkey FOREIGN KEY (post_id) REFERENCES public.posts(post_id) ON UPDATE CASCADE ON DELETE CASCADE;
 N   ALTER TABLE ONLY public.post_images DROP CONSTRAINT post_images_post_id_fkey;
       public          postgres    false    205    2971    208            ?           2606    25933 !   posts posts_administrator_id_fkey    FK CONSTRAINT     ?   ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_administrator_id_fkey FOREIGN KEY (administrator_id) REFERENCES public.administrators(administrator_id) ON UPDATE CASCADE ON DELETE SET NULL;
 K   ALTER TABLE ONLY public.posts DROP CONSTRAINT posts_administrator_id_fkey;
       public          postgres    false    2965    205    200            ,   ?  x?}??r?@E??2Ʀy??D??OPQ?VQ??4B?4(??%??&?=???U??q}??8C????0/?|??K?q??ׇ?\J???Z?ń?+q?r2ڳ??????v'????? ?v>{?_RM??TA???? ;|??C?t????OR?Za???????B?ښ?#ͳ?[P;??q??TN???#:???`>j?o????IƇ?zEQ?ȓ$N3?ϴ!2Y??7E?S?Ω\?rm\Y???P<???B?b(Y/v????x?x??]?OfY???;??kj?@?t8???xP??z>?Ri9UK?]n{?/eM???s2T?(VO?@?E?t??P!Ft???}o?????]\????<Ϫ>F?Dߙ???ꍖ??_???")rw?]?6sb??ߞx?̇???V5??S?|Z?@?{?,?vr??
?r @G? ??Gbt?`?S???o?Ȯ?z????Bq?rw3p΂c???y?)?D??k?f????%'Q{}1?????? ?]r??G4Ba?z?y?l?!g?????5Su?Pb	H׵5ۦ:q?C??X???c?tf???W?6{[?tsO ?T?????ꉜT뉌?A?	?PSǴ?G
??X??WdR?.>c?8-+?gNN#ϙ?ə??\????e?S`<u?Ĥ?̎??N߳????Z??h4???b?      -     x??Wێ?6}?~???E????,_?N?d??m?h?-J?lƒ????F??P?l?v?M??ƚ?9?{?S,???I?#??@K??o?Fr??'???\'?<???c?.??J??Ol{]?????[1?Q???v?Å????T???cFJ?]!}?p:3ZT?%B`?yw?oA܂?x&???Up-ҭ???|f?_3S?etkF??0?	d???pfF?2????:L???Õ??WMb:??"??v??????????%?n????
1?a?J??Ș_??\??3R???ϋ1???;?Z??XU??<p??\?T??
18?<h?}'?Gθ???vk??C?v?'??-r?????=jA>(??%??????HZԲ5O???F	?vM??(?mqE
??f????b?ᙑ??M?????.??0QF??$?L1????QbB0??%?0$>"??eH?5?H?>?3???cd?Ud??????p<B/?5?g????u?Q????p.y??A?t????-)????o??????*+?z?ǟ? ?!k/?}??,??̵??j??T+T?쫦??JȦ???1$(3Z?A6?&zDŪ'?ު^(e(??e"V3*???0Y???????Ǜ?7???&??@&t_?Īʣ?3{Lk'H???!?:??ʞ???kn?U??+鐦????G8?_,o~?n??_?x?(?HTϤ?1[?	N?N)?,?lfH?d?L?,?0.?????j8?v?j??8i?w?|=???+I??#??}???F??j??Z?=?IW.2??????Ʈ	N1?cF9??,I????.?W8?RU?XX)?????
,l?,^<?y??~y?Fy6s??`??䳍?X?0??`??_?'?S?K??]GB??B?m?o?R?öJ'?$??B?l?$?)Z??W?i???=??L ???D?R?{?Ja?"? ??`?U?D?yبo?MZ?\y??7?WuM}SQ????1'<?T?dAo6??R&?չダ?o{??`????ݡ?JOu?w??z?-?{???=o???7V?ǝiL??Λ??9?
? T&׍6??_n1?Vz??O5??Oj?wR???????u??8#7T?*????xS????p?QcJ3??k??f?^?2@f]᧙h|????M?=?+????=_?f?R.-?7?;?i~{?-[??8?0?˭???L3Me3?%-8?[?g??{~utu?A??y??E???iI9??NRr??)H4???n?dm?8?3m???B?\?B?T?f?͗?ӥ?bUfذ#C??Sݖ?u_?_+??...?????      8   ?  x?UV?n?8}?????B???i??v?,?(`hcw?̌=?????{t???b??!-?????????JrQ
)??E?ջ?????,?q??מF??Թ??v????tu詁P?AX??ߎK???i??=?e?,?~?x?q??.?W??	Nw??
??|?dN?ڨ??Aqu\)??WL1Ljz??M>???ii?T???1?? ?+?	A??χ%????::i{?2???=??d??_c;K??7'?^
?E^?׷{&r?b:s????͹??`aJ?CS?È?a]c????|w?B̂??p?Q?a?c?h?~20?^??9u5F????
??4 ??TFO?t6]??:WY??\}?2?I΅T?:{??y?8???b"&??P?q0(#Y?l?R?,L:Fu?#?[`???O00?!oo&??i?k5o(?=??p??[?R`aW?{n	?<?;???z04π-vc?y	=???>?h?q_ַ-zm???I??M=R?3?u?߉]<?71?Ḓ?G?#???c֢?ɒ?zޛ?1:?7????c-?,??????ԓ??&?d?U?t?g?>?g3Ns7????<???b?o?L??ɧ~l??f??'/PT?S?14?[?rM????~U?a?w?????Y0???5?xy??+^ U???N}rs???L??}??2WEt?Ȥ??/I?????#ٰ v-?.?0z????f?9&w?ƈ??͋U?ko*?y?K@??2?`D$_?d???:?t@W??C?.??䨃,E??????0?etsB9???????䪻?1?-t???$?BX??ɚ?$???J?7C??T??T4?HZ?=yP@??en?%qd?pz4j?T&J???:vr??+?e;?͸.N?p?ٿW??	&?uk̩3?????ƥ?4???<!?'w?NYM???SV?~Xc)L??M?q)p?ǥǲ%;?x?n(A@/? Q???N?E:8ogB?G̿d??nJ^??s!ў"K??815??[3??6??|??#?Տ ?J????x??´?????r5?k??K?F_ǔ?_?d???ǭ?&'???HL??TWM?Z?Y@??4.D??LC??n?
???iE?`??[????~0????^W?C?}?ՊJ/(??}nM?j?e??i TQ!r@??ΞF;?;??c ???C???j??t??jM5??_??)p)p??rN?'w????d~???+???U?`??Ew?1??$͍?dna??1??MR9#      .   ?  x??TMo?0=˿§?<4???サk?-?t??? ??ږ}4??E?N?a?.?{??$>?????ڀق?:??hj5gZ~J??e?!?A{؃?V????	?@?R?',?.Rl??zw1???L?h]C?ZO(??R쵏Ϩ???S4????r9y???V?@?VRZ??,?fgǺ?M?$\g*???CS{??j5!ɟ?W??U:"$?+??D?n??Q?$?SPkf$c&???t????t䀘j???P3ѱu??[*?T?v?d??r?T?׹*??-???+l?[??(????5??#?,;??׊v??~?k?`$??(8ܣ?~Q??E???,?Fz?:{?[kl??V???#Lm:???	{tklgkT?	I??قv?LC????!b?? ?v?v?A???????qP_??E1;?V????9;??>??bB?g?8??Z$P???܉8?̥?????}?1?ɏOGX4??NC?N?;?????D???PF?g76??=??V??w	??,W????z?{??`_6???(5O=?g?
???m???a????'Z?+??h???4`?5?\k%T?#?9???JOZ?jM?A-sP?lv<?yj?9??*??,??Ƒ6????????S7Ǉy???u|???7[???????xz_?o???7      A   ?   x?M??N?0??ӧ?????{??B?Z??.\,ջ??????'?p?4???G?;?Bc?y????|?ƒUg? ވ,?ȫ??x????N<R???jXy??Aߧ?=?4?z4?@W??n;*?N??+X???ޢ[?g?U'L~???<??ؑ??Y貛??8??g@G??????z??^?W???q"??{U/??!A?S??	?;?*Z????M?-?q?????&?#l?*?5??=?q1?b??,K?d?q?e?7????      /      x?????? ? ?      0   ]  x?uTێ?0}?|?@7??5?V???Fm?}Y??/?6?(_OR6O3??Lf?'M`Gm???J???;??+	?a1?ZQ???tĉ??a?Jh????1][d4 ??2l?'??N吡h????p????2?ʓ?"?l?A3V?3<R?E֞H???%T?dZN???J\??P9?????2?ܓI=Yu?]J?H??,]?_????D:J????? ?M?ݻ?+??i?G[[?i??5|d??#m?^?x?˙???%??? ?3[?????MzFH|#D??}#Uފs7Q?%??O?"3P?9V];f?[?????\x?J$'?q? %??@IV??%????iy=IG???/?Pӹ???ou??bX#????u5?p?VP????⟱?Za	?X?r?B???h????6??oC̏s??=?u)?,?擋X????LO??????h?J??]Y?riv??P?Թs??7?.?????S?9??ݸ??[e2?}???2<u?ԗ?~U?~K>y??h[G?d583??^c.???-zoL???2Q? ????.?:???rg?_??? ??kрk:Y?E? ?Q???O??˸??m??J]??i6??Q?>?      2      x?3?4?????? f      3      x?????? ? ?      4      x?????? ? ?      1   ?  x???Mo?0???W??75@?t?Ro?z?Þ*?&5??C@ؔ??	Q??h?Xb?????dE?"ۼ??]*zY??T?;?|?.
?{B???????~ ??"'?/?&x̲?q?ٚgk??Y??? ??H?	?qWxh=?2Q??>?{mځ?=??r?T?)?ߵ))'?DZcu:Zȕ?eyy?p??Aw??{dK:`r???I????z3?Z????꼹?b"?J?L%?j????lٻxIn?f̚??c??ݙյ5?8?_?"Q&d??Ad?x??8m
lEӃ??ۼ3>?]??^B???e?u??U?m?x??e??|}?<?????????/?U?|Jhf~6?m?????pG?c?I?gy0<????]KA??#8Z??3??Z?X8?4X?t????Y??GM??????"???-      C   U   x??0??H?K)?T?--.I??̅??a?x##CK 6552?+?K????I?-(?KWN?I,I??4??4503043?0?????? 8j?      5      x?????? ? ?      6     x?mSMs?H=?~E?/?j ?????$UN?T*;?͖??1j>??z?{?$?t????3ނ?4??-??f???~I)ע???#??Y?8cy??}??<?Bz??#ߛ@A?u?%?<??1^????V???u?W֦ܤ,??<?Nx\?۵U9?S??f????}?E?$??n?	?f
?g??ʱ?cQY???fjaWO???ϲ??}ے?k??t?????<??K??U?r٣C֔?ؘ????J??ٗן?k?m?~?????????????#[0LSŵf?1G	?V	??N?c??7??p???v?.QfS?.?+?)*??????;ZTG^4??g??l??|/ZE? 
?~????B?#4
WQ?P??<^?\'JTF????w?*P??4Z?
??1*????:?-T?FԴ??nm1??̅?)?d@.*k???Xm?`?`'??M]??????5?)??-W[?????û?`߱?*+?s?O??H??.>P?Vyh?n^#L??????O????=q'H?????2??%?[M???o?WycZt9`??ӽ???u?%u4F$??Wy??9@???J.N?G??!?????Ҵ??{??H/?\:??????????;2?@-dZ?n??`?\<O=>????h?wV&?Y?Vh<???q+?7cT?-?4z????C????)??7h?x2!?c?????p?t??6???G??`?$? ???????????~?<????_W?S???yTOE??B;??*?7?T?M?40?xl?????$q??     